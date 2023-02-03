<?php
include '../core/config.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//smokereading
//heatreading
//latitude
//longitude

if (isset($_GET['latitude']) && isset($_GET['longitude'])) {
    $lat = $_GET['latitude'] == 0 ? '10.642612789500305': $_GET['latitude'];
    $lng = $_GET['longitude'] == 0 ? '122.93891728037974': $_GET['longitude'];
} else {
    $lat = '10.642612789500305';
    $lng = '122.93891728037974';
}

$coordinates = "$lat,$lng";
$Notif = new Notifications();
$notif_address = $Notif->getAddress($lat, $lng);
$form = array(
    'smokereading'  => isset($_GET['smokereading']) ? $_GET['smokereading'] : 0,
    'heatreading'   => isset($_GET['heatreading']) ? $_GET['heatreading'] : 0,
    'notif_title'   => 'Fire Alert',
    'notif_message' => 'There is a fire in your area',
    'coordinates'   => $coordinates, //'10.6826927,122.9438081', FROM DEVICE
    'notif_address' => $notif_address,
);

$Notif->inputs = $form; //$_POST;
$notif_id = $Notif->add();
$Notif->checker($notif_id);
echo $notif_address;
