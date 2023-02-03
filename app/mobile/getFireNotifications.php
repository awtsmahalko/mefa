<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once 'core/config.php';

$data = json_decode(file_get_contents("php://input"));

if(isset($data->user_id) && !empty($data->user_id )){

	$user_id = $mysqli_connect->real_escape_string($data->user_id);

	$response = array();
    
	$fetch = $mysqli_connect->query("SELECT w.id, w.message, n.coordinates, n.fire_out FROM tbl_web_notifications w LEFT JOIN tbl_notifications n ON w.notif_id=n.notif_id where w.user_id='$user_id' and (n.fire_out=0 or (n.fire_out = 1 AND DATE(n.date_added) = CURDATE() )) ") or die(mysql_error());
	while($row = $fetch->fetch_array()){
        $list = array();
        $list['notif_id'] = $row[0];
        $list['notif_message'] = $row[1];

        $coordinates = explode(",",$row[2]);
        $list['fire_out'] = $row[2];

        $list['notif_lat'] = $coordinates[0];
        $list['notif_lng'] = $coordinates[1];

        array_push($response, $list);
    }

	echo json_encode($response);

}

?>