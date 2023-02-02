<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once 'core/config.php';

$data = json_decode(file_get_contents("php://input"));

if(isset($data->property_id) && !empty($data->property_id )){

	$property_id = $mysqli_connect->real_escape_string($data->property_id);

	$response = array();
    
	$fetch = $mysqli_connect->query("SELECT * FROM tbl_properties where property_id='$property_id' ") or die(mysql_error());
	$row = $fetch->fetch_assoc();

    $list = array();
    $list['property_id'] = $row['property_id'];
    $list['property_name'] = $row['property_name'];
    $list['property_address'] = $row['property_address'];
    $list['property_radius'] = $row['property_radius'];

    $coordinates = explode(",",$row['property_coordinates']);

    $list['property_lat'] = $coordinates[0];
    $list['property_lng'] = $coordinates[1];

    array_push($response, $list);

	echo json_encode($response);

}

?>