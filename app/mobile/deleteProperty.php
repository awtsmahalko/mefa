<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once 'core/config.php';

$data = json_decode(file_get_contents("php://input"));

if(isset($data->property_id) && $data->property_id > 0){
	$property_id = $mysqli_connect->real_escape_string($data->property_id);

	$sql = $mysqli_connect->query("DELETE from tbl_properties WHERE property_id='$property_id' ");

	if($sql){
		echo 1;
	}else{
		echo 0;
	}

}

?>