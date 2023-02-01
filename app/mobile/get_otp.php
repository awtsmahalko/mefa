<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once 'core/config.php';

$data = json_decode(file_get_contents("php://input"));


if(isset($data->user_email) && !empty($data->user_email) ){
	
	$user_email = $mysqli_connect->real_escape_string($data->user_email);

	$date = getCurrentDate();

	$fetch_rows = $mysqli_connect->query("SELECT user_id from tbl_users where user_email='$user_email'") or die(mysqli_error());
	$row = $fetch_rows->fetch_array();

	$response = array();

	if($row[0] > 0){
	    $generated_otp = generateRandomString(6);
	    $sql = $mysqli_connect->query("UPDATE tbl_users SET user_otp='$generated_otp' WHERE user_id='$row[0]'  ") or die(mysqli_error());
	    
	    if($sql){
	        emailSender($user_email, $generated_otp);
	        $res = 1;
	    }else{
	         $res = 0;
	    }
	    
	    $response['response'] = $res;
		

	}else{
		$response['response'] = -1;
	}

	echo json_encode($response);
	
}

?>