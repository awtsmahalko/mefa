<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once 'core/config.php';

$data = json_decode(file_get_contents("php://input"));


if(isset($data->user_otp) && !empty($data->user_otp) ){
	
	$user_email = $mysqli_connect->real_escape_string($data->user_email);
    $user_otp = $mysqli_connect->real_escape_string($data->user_otp);

	$date = getCurrentDate();

	$fetch_rows = $mysqli_connect->query("SELECT user_otp from tbl_users where user_email='$user_email'") or die(mysqli_error());
	$row = $fetch_rows->fetch_array();

	$response = array();

	if($row[0] == $user_otp){
	    
	    $response['response'] = 1;

	}else{
		$response['response'] = -1;
	}

	echo json_encode($response);
	
}

?>