<?php
include '../core/config.php';

$form = array(
    'notif_title'   => 'Fire Alert',
    'notif_message' => 'There is a fire in your area',
    'coordinates'   => '10.63629241849944,122.9585436492834', //'10.6826927,122.9438081', FROM DEVICE
);

$Notif = new Notifications();
$Notif->inputs = $form; //$_POST;
echo $Notif->add();
