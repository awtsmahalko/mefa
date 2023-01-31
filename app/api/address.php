<?php
$lat = '10.642612789500305';
$lng = '122.93891728037974';

$url = "http://maps.google.com/maps/api/geocode/json?latlng=$lat,$lng&key=AIzaSyC232qKEVqI5x0scuj9UGEVUNdB98PiMX0&sensor=false";

// send http request
$geocode = file_get_contents($url);
$json = json_decode($geocode);
echo json_encode($json);