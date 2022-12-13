<?php
class Notifications extends Connection
{
    private $table = 'tbl_notifications';
    public $pk = 'notif_id';
    public $name = 'notif_message';

    private $table_web = 'tbl_web_notifications';

    public function pushNotif($title, $message, $device_id)
    {
        //API URL of FCM
        $url = 'https://fcm.googleapis.com/fcm/send';

        /*api_key available in:
        Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key*/
        $api_key = 'AAAAMMyIlI0:APA91bEq8wlsqm_gffhxQJvfT4vG0Oo-NV7xGwCtpbgYuzszSJOAnLms8dBB-xj6t1Tf9FyohA_5Gkqdl3AKKKL-e6ffHXlJXirAO0afXXX2tRsHFWXPJ0ZsOVdu0MVWY4urlvZpu0eL';

        $fields = array(
            'registration_ids' => array(
                $device_id
            ),
            /*'data' => array (
                "message" => $message,
                "body" => "Test",
                "title" => "Title"
        )*/
            'notification' => array(
                "body" => $message,
                "title" => $title
            ),
            'data' => array(
                'priority' => 10
            )
        );

        //header includes Content type and api key
        $headers = array(
            'Content-Type:application/json',
            'Authorization:key=' . $api_key
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);
        return $result;
    }

    public function webNotif($notif_id, $user_id)
    {
        $form = array(
            'notif_id'  => $notif_id,
            'user_id'   => $user_id,
        );
        return $this->insert($this->table_web, $form);
    }

    public function add()
    {
        $sensor_smoke   = $this->clean($this->inputs['smokereading']);
        $sensor_heat    = $this->clean($this->inputs['heatreading']);
        $notif_title    = $this->clean($this->inputs['notif_title']);
        $notif_message  = $this->clean($this->inputs['notif_message']);
        $coordinates    = $this->clean($this->inputs['coordinates']);
        $notif_address  = $this->clean($this->inputs['notif_address']);

        $form = array(
            'sensor_smoke'  => $sensor_smoke,
            'sensor_heat'   => $sensor_heat,
            'notif_title'   => $notif_title,
            'notif_message' => $notif_message,
            'coordinates'   => $coordinates,
            'notif_address' => $notif_address
        );
        return $this->insert($this->table, $form);
    }

    public function checker()
    {
        $response = [];
        $result = $this->select($this->table, '*', "notif_status = 0 ORDER BY date_added ASC");
        while ($row = $result->fetch_assoc()) {
            $fire_coordinates = explode(",", $row['coordinates']);
            $fire_lat = $fire_coordinates[0] * 1;
            $fire_lng = $fire_coordinates[1] * 1;

            $result2 = $this->select('tbl_properties');
            while ($row2 = $result2->fetch_assoc()) {
                $property_coordinates = explode(",", $row2['property_coordinates']);
                $_lat = $property_coordinates[0] * 1;
                $_lng = $property_coordinates[1] * 1;
                $property_radius = $row2['property_radius'] * 1;

                if ($this->getDistance($fire_lat, $fire_lng, $_lat, $_lng, $property_radius) == 1) {
                    $user_token = Users::token($row2['user_id']);
                    $message = "There is a fire near in your property " . $row2['property_name'];
                    $response[] = $this->pushNotif($row['notif_title'], $message, $user_token);
                    $this->webNotif($row['notif_id'], $row2['user_id']);
                }
            }

            $result3 = $this->select('tbl_users', '*', "user_category = 'R' AND user_resident_coordinates !=''");
            while ($row3 = $result3->fetch_assoc()) {
                $user_coordinates = explode(",", $row3['user_resident_coordinates']);
                $_lat = $user_coordinates[0] * 1;
                $_lng = $user_coordinates[1] * 1;
                $resident_radius = $row2['user_radius'] * 1;

                if ($this->getDistance($fire_lat, $fire_lng, $_lat, $_lng, $resident_radius) == 1) {
                    $message = "There is a fire near in your location.";
                    $response[] = $this->pushNotif($row['notif_title'], $message, $row3['user_token']);
                }
            }


            $this->update($this->table, ['notif_status' => 1], "notif_id = '$row[notif_id]'");
        }
        echo json_encode($response);
    }

    public function dailyAlert()
    {
        $response['data']['lists'] = array();
        if ($_SESSION['user']['category'] == 'R') {
            $result = $this->table("tbl_web_notifications AS w")
                ->join("tbl_notifications AS n", "w.notif_id", "=", "n.notif_id")
                ->selectRaw("coordinates", "n.date_added", "notif_address")
                ->where("w.user_id", $_SESSION['user']['id'])
                ->orderBy("n.date_added ASC")
                ->get();
        } else {
            $result = $this->select($this->table, "*", "notif_id > 0 ORDER BY date_added ASC");
        }

        $last_time = date("Y-m-d H:i:s");
        while ($row = $result->fetch_assoc()) {
            $coords = explode(",", $row['coordinates']);
            $form = [
                'lat' => (float) $coords[0],
                'lng' => (float) $coords[1],
                'label' => date("h:i A", strtotime($row['date_added'])),
                'date_time' => date("F d, Y h:i A", strtotime($row['date_added'])),
                'address' => $row['notif_address']
            ];
            array_push($response['data']['lists'], $form);
            $last_time = $row['date_added'];
        }
        $_SESSION['alert']['live_last_time'] = $last_time;
        return json_encode($response);
    }

    public function liveAlert()
    {
        $last_time = $_SESSION['alert']['live_last_time'];

        $response['data']['lists'] = array();
        if ($_SESSION['user']['category'] == 'R') {
            $result = $this->table("tbl_web_notifications AS w")
                ->join("tbl_notifications AS n", "w.notif_id", "=", "n.notif_id")
                ->selectRaw("coordinates", "n.date_added", "notif_address")
                ->where("w.user_id", $_SESSION['user']['id'])
                ->where("n.date_added", ">", $last_time)
                ->orderBy("n.date_added ASC")
                ->get();
        } else {
            $result = $this->select($this->table, "*", "notif_id > 0 AND date_added > '$last_time' ORDER BY date_added ASC");
        }


        while ($row = $result->fetch_assoc()) {
            $coords = explode(",", $row['coordinates']);
            $form = [
                'lat' => (float) $coords[0],
                'lng' => (float) $coords[1],
                'label' => date("h:i A", strtotime($row['date_added'])),
                'date_time' => date("F d, Y h:i A", strtotime($row['date_added'])),
                'address' => $row['notif_address'], //$this->getAddress($coords[0], $coords[1])
            ];
            array_push($response['data']['lists'], $form);
            $last_time = $row['date_added'];
        }
        $_SESSION['alert']['live_last_time'] = $last_time;
        return json_encode($response['data']);
    }

    public function userAlert()
    {
    }

    public function getDistance($gpsLat, $gpsLong, $userLat, $userLong, $userRadius)
    {
        $isInsideRadius = 0;
        $theta = $userLong - $gpsLong;
        $distance = sin(deg2rad($userLat)) * sin(deg2rad($gpsLat)) +  cos(deg2rad($userLat)) * cos(deg2rad($gpsLat)) * cos(deg2rad($theta));

        $distance = acos($distance);
        $distance = rad2deg($distance);

        // Miles = ($distance * 60 * 1.1515)
        // Kilometers = 1.609344
        $distanceInKm = $distance * 60 * 1.1515 * 1.609344;
        if ($distanceInKm < $userRadius) {
            // inside the defaultRadius
            $isInsideRadius = 1;
        }

        return $isInsideRadius;
    }

    public function getAddress($latitude, $longitude)
    {
        //google map api url
        $url = "http://maps.google.com/maps/api/geocode/json?latlng=$latitude,$longitude&key=AIzaSyC232qKEVqI5x0scuj9UGEVUNdB98PiMX0&sensor=false";

        // send http request
        $geocode = file_get_contents($url);
        $json = json_decode($geocode);
        $address = $json->status == 'REQUEST_DENIED' ? "Bacolod City" : $json->results[0]->formatted_address;
        return $this->clean($address);
    }
}
