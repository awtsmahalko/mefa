<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once 'core/config.php';

$data = json_decode(file_get_contents("php://input"));
$user_id = $data->user_id;
$fetch = $mysqli_connect->query("SELECT * FROM tbl_web_notifications WHERE user_id='$user_id' ORDER BY date_added DESC");
$response = array();
while ($row = $fetch->fetch_array()) {
    $list = array();
    $list['id'] = $row['id'];
    //$list['user'] = getUser($row['user_id']);
    $list['notif_title'] = "Fire Alert!"; //$row['notif_title'];
    $list['notif_message'] = $row['message'];
    // $list['coordinates'] = $row['coordinates'];
    // $list['sensor_smoke'] = $row['sensor_smoke'];
    // $list['sensor_heat'] = $row['sensor_heat'];
    $list['date_added'] = date('M d, Y h:i A', strtotime($row['date_added']));
    array_push($response, $list);
}

echo json_encode($response);
?>