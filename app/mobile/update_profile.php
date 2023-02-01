<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once 'core/config.php';

$data = json_decode(file_get_contents("php://input"));

if(isset($data->user_id) && $data->user_id > 0){
	$user_id = $mysqli_connect->real_escape_string($data->user_id);
	$user_fullname = $mysqli_connect->real_escape_string($data->user_fullname);
	$user_mobile = $mysqli_connect->real_escape_string($data->user_mobile);
	$user_address = $mysqli_connect->real_escape_string($data->user_address);
	$user_email = $mysqli_connect->real_escape_string($data->user_email);
	$username = $mysqli_connect->real_escape_string($data->username);
	$date = getCurrentDate();

	$sql = $mysqli_connect->query("UPDATE `tbl_users` SET `username`='$username', user_fullname='$user_fullname', user_mobile='$user_mobile', user_address='$user_address', user_email='$user_email' WHERE user_id='$user_id' ");

	if($sql){
		echo 1;
	}else{
		echo 0;
	}

}

?>