<?php
include '../core/config.php';
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

$Notif = new Notifications();

$form = $Notif->liveAlert();

echo "data: " . $form . "\n\n";
flush();
