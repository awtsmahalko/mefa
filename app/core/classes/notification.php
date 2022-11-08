<?php
class Notifications extends Connection
{
    private $table = 'tbl_notifications';
    public $pk = 'notif_id';
    public $name = 'notif_message';

    private $api_key = "AAAAMMyIlI0:APA91bEq8wlsqm_gffhxQJvfT4vG0Oo-NV7xGwCtpbgYuzszSJOAnLms8dBB-xj6t1Tf9FyohA_5Gkqdl3AKKKL-e6ffHXlJXirAO0afXXX2tRsHFWXPJ0ZsOVdu0MVWY4urlvZpu0eL";
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
    }

    public function add()
    {
        $sensor_smoke   = $this->clean($this->inputs['smokereading']);
        $sensor_heat    = $this->clean($this->inputs['heatreading']);
        $notif_title    = $this->clean($this->inputs['notif_title']);
        $notif_message  = $this->clean($this->inputs['notif_message']);
        $coordinates    = $this->clean($this->inputs['coordinates']);

        $form = array(
            'sensor_smoke'  => $sensor_smoke,
            'sensor_heat'   => $sensor_heat,
            'notif_title'   => $notif_title,
            'notif_message' => $notif_message,
            'coordinates'   => $coordinates,
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
                }
            }

            // $result3 = $this->select('tbl_users', '*', "user_category = 'R' AND user_coordinates !=''");
            // while ($row3 = $result3->fetch_assoc()) {
            //     $user_coordinates = explode(",", $row3['user_coordinates']);
            //     $_lat = $user_coordinates[0] * 1;
            //     $_lng = $user_coordinates[1] * 1;

            //     if ($this->getDistance($fire_lat, $fire_lng, $_lat, $_lng, 2) == 1) {
            //         $message = "There is a fire near in your location.";
            //         $response[] = $this->pushNotif($row['notif_title'], $message, $row3['user_token']);
            //     }
            // }


            $this->update($this->table, ['notif_status' => 1], "notif_id = '$row[notif_id]'");
        }
        echo json_encode($response);
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
}
