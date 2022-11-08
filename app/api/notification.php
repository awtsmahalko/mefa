<?php
include '../core/config.php';

//smokereading
//heatreading
//latitude
//longitude

if (isset($_GET['latitude']) && isset($_GET['longitude'])) {

    $coordinates = $_GET['latitude'] . ',' . $_GET['longitude'];
    $form = array(
        'smokereading'  => isset($_GET['smokereading']) ? $_GET['smokereading'] : 0,
        'heatreading'   => isset($_GET['heatreading']) ? $_GET['heatreading'] : 0,
        'notif_title'   => 'Fire Alert',
        'notif_message' => 'There is a fire in your area',
        'coordinates'   => $coordinates, //'10.6826927,122.9438081', FROM DEVICE
    );

    $Notif = new Notifications();
    $Notif->inputs = $form; //$_POST;
    $Notif->add();
    $Notif->checker();
}
