<?php
include '../core/config.php';
// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Headers: access");
// header("Access-Control-Allow-Methods: POST");
// header("Content-Type: application/json; charset=UTF-8");
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//smokereading
//heatreading
//latitude
//longitude

if (isset($_GET['latitude']) && isset($_GET['longitude'])) {

    $Notif = new Notifications();
    $coordinates = $_GET['latitude'] . ',' . $_GET['longitude'];
    $form = array(
        'smokereading'  => isset($_GET['smokereading']) ? $_GET['smokereading'] : 0,
        'heatreading'   => isset($_GET['heatreading']) ? $_GET['heatreading'] : 0,
        'notif_title'   => 'Fire Alert',
        'notif_message' => 'There is a fire in your area',
        'coordinates'   => $coordinates, //'10.6826927,122.9438081', FROM DEVICE
        'notif_address' => $Notif->getAddress($_GET['latitude'], $_GET['longitude']),
    );

    $Notif->inputs = $form; //$_POST;
    $Notif->add();
    $Notif->checker();
}
