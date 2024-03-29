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
	$new_password = $mysqli_connect->real_escape_string($data->new_password);

	$date = getCurrentDate();

	$sql = $mysqli_connect->query("UPDATE tbl_users SET password=md5('$new_password') WHERE user_email='$user_email' and user_otp='$user_otp' ") or die(mysqli_error());

	if($sql){
		$response['response'] = 1;
	}else{
		$response['response'] = 0;
	}

	echo json_encode($response);
	
}

?>