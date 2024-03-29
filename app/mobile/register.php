<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once 'core/config.php';

$data = json_decode(file_get_contents("php://input"));

if(isset($data->username) && !empty($data->username) ){
	$user_fullname = $mysqli_connect->real_escape_string($data->user_fullname);
    $user_address = $mysqli_connect->real_escape_string($data->user_address);
	$user_mobile = $mysqli_connect->real_escape_string($data->user_mobile);
	$user_email = $mysqli_connect->real_escape_string($data->user_email);
    $category = "R";
	
	$username = $mysqli_connect->real_escape_string($data->username);
	$password = $mysqli_connect->real_escape_string($data->password);

	$date = getCurrentDate();

	$fetch_rows = $mysqli_connect->query("SELECT username, user_email from tbl_users where (username='$username' or user_email='$user_email') ") or die(mysqli_error());
	$rows = $fetch_rows->fetch_array();

	if($rows['username'] == $username){
		echo -1;
	}else if($rows['user_email'] == $user_email){
		echo -2;
	}else{
		$sql= $mysqli_connect->query("INSERT INTO `tbl_users`(`user_fullname`, `user_address`, `username`, `password`, `user_category`, `date_added`, user_mobile, user_email) VALUES ('$user_fullname','$user_address','$username',md5('$password'),'$category','$date', '$user_mobile', '$user_email')") or die(mysqli_error());
			
		if($sql){
			$user_id = $mysqli_connect->insert_id;
			echo $user_id;
		}else{
			echo 0;
		}
		
	}
	
}

?>