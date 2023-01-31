<?php
class Notifications extends Connection
{
    private $table = 'tbl_notifications';
    public $pk = 'notif_id';
    public $name = 'notif_message';

    private $table_web = 'tbl_web_notifications';

    public $inputs = [];

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

    public function webNotif($notif_id, $user_id, $message = '')
    {
        $form = array(
            'notif_id'  => $notif_id,
            'user_id'   => $user_id,
            'message'   => $this->clean($message),
            'date_added' => $this->getCurrentDate(),
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
            'notif_address' => $notif_address,
            'date_added'    => $this->getCurrentDate(),
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

            $response[] = $this->checkLocations($fire_lat,$fire_lng,$row['notif_id'],$row['notif_title'],$row['notif_address']);
            $response[] = $this->checkResidentLocation($fire_lat,$fire_lng,$row['notif_id'],$row['notif_title'],$row['notif_address']);
            $response[] = $this->checkDepartments($fire_lat,$fire_lng,$row['notif_id'],$row['notif_title'],$row['notif_address']);

            $this->update($this->table, ['notif_status' => 1], "notif_id = '$row[notif_id]'");
        }
        echo json_encode($response);
    }

    public function checkLocations($fire_lat,$fire_lng,$notif_id,$notif_title,$notif_address)
    {
        $response = [];
        $result = $this->select('tbl_properties');
        while ($row = $result->fetch_assoc()) {
            $property_coordinates = explode(",", $row['property_coordinates']);
            $_lat = $property_coordinates[0] * 1;
            $_lng = $property_coordinates[1] * 1;
            $property_radius = $row['property_radius'] * 1;

            if ($this->getDistance($fire_lat, $fire_lng, $_lat, $_lng, $property_radius) == 1) {
                $user_token = Users::token($row['user_id']);
                $message = "There is a fire in $notif_address near in your " . $row['property_name']."'s location";
                $response[] = $this->pushNotif($notif_title, $message, $user_token);
                $this->webNotif($notif_id, $row['user_id'], $message);
            }
        }
        return $response;
    }

    public function checkResidentLocation($fire_lat,$fire_lng,$notif_id,$notif_title,$notif_address)
    {
        $response = [];
        $result = $this->select('tbl_users', '*', "user_category = 'R' AND user_resident_coordinates !=''");
        while ($row = $result->fetch_assoc()) {
            $user_coordinates = explode(",", $row['user_resident_coordinates']);
            $_lat = $user_coordinates[0] * 1;
            $_lng = $user_coordinates[1] * 1;
            $resident_radius = $row['user_radius'] * 1;

            if ($this->getDistance($fire_lat, $fire_lng, $_lat, $_lng, $resident_radius) == 1) {
                $message = "There is a fire in $notif_address near in your Resident";
                $response[] = $this->pushNotif($notif_title, $message, $row['user_token']);
                $this->webNotif($notif_id, $row['user_id'], $message);
            }
        }
        return $response;
    }

    public function checkDepartments($fire_lat,$fire_lng,$notif_id,$notif_title,$notif_address)
    {
        $response = [];
        $result = $this->select('tbl_users', '*', "user_category = 'F' AND department_id > 0");
        while ($row = $result->fetch_assoc()) {
            $data_ = Departments::dataOf($row['department_id']);

            $user_coordinates = explode(",", $data_['department_coordinates']);
            $_lat = $user_coordinates[0] * 1;
            $_lng = $user_coordinates[1] * 1;
            $resident_radius = $data_['department_radius'] * 1;

            if ($this->getDistance($fire_lat, $fire_lng, $_lat, $_lng, $resident_radius) == 1) {
                $message = "There is a fire in $notif_address near in your Fire Department : ".$data_['department_name'];
                $response[] = $this->pushNotif($notif_title, $message, $row['user_token']);
                $this->webNotif($notif_id, $row['user_id'], $message);
            }
        }
        return $response;
    }

    public function dailyAlert()
    {
        $last_time = date("Y-m-d 00:00:00");

        $response['data']['lists'] = array();
        if ($_SESSION['user']['category'] == 'R') {
            $result = $this->table("tbl_web_notifications AS w")
                ->join("tbl_notifications AS n", "w.notif_id", "=", "n.notif_id")
                ->selectRaw("n.notif_id","coordinates", "n.date_added", "notif_address", "message")
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
                'id' => $row['notif_id'],
                'lat' => (float) $coords[0],
                'lng' => (float) $coords[1],
                'label' => date("h:i A", strtotime($row['date_added'])),
                'date_time' => date("F d, Y h:i A", strtotime($row['date_added'])),
                'address' => $row['notif_address'],
                'message' => $_SESSION['user']['category'] == 'R' ? $row['message'] : $row['notif_message']
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
                ->selectRaw("coordinates", "n.date_added", "notif_address", "message")
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
                'message' => $_SESSION['user']['category'] == 'R' ? $row['message'] : $row['notif_message']
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
        $url = "https://maps.google.com/maps/api/geocode/json?latlng=$latitude,$longitude&key=AIzaSyC232qKEVqI5x0scuj9UGEVUNdB98PiMX0&sensor=false";

        // send http request
        $geocode = file_get_contents($url);
        $json = json_decode($geocode);
        $address = $json->status == 'REQUEST_DENIED' ? "Bacolod City" : $json->results[0]->formatted_address;
        return $this->clean($address);
    }

    public function yearlyReport()
    {
        $response = array();
        $current_year = date('Y');
        $last_year = $current_year - 1;

        $years = [$last_year, $current_year];

        foreach ($years as $year) {
            $data = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

            $result = $this->select($this->table, 'COUNT(notif_id) AS count,MONTH(date_added) - 1 AS mo', "YEAR(date_added) = $year GROUP BY MONTH(date_added)");
            while ($row = $result->fetch_assoc()) {
                $data[$row['mo']] = (int) $row['count'];
            }

            $_year = array(
                'name' => "Year $year",
                'data' => $data,
            );
            array_push($response, $_year);
        }

        return json_encode($response);
    }

    public function fire_out()
    {
        $notif_id = $this->clean($this->inputs['notif_id']);
        return $this->update($this->table, ['fire_out' => 1], "notif_id = '$notif_id'");
    }
}
