<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once 'core/config.php';

$data = json_decode(file_get_contents("php://input"));

if(isset($data->property_id) && !empty($data->property_id )){

	$property_id = $mysqli_connect->real_escape_string($data->property_id) * 1;
    $user_id = $mysqli_connect->real_escape_string($data->user_id);

	$response = array();

    if($property_id == -1){
        $fetch = $mysqli_connect->query("SELECT user_resident_coordinates, user_radius FROM tbl_users where user_id='$user_id' ") or die(mysql_error());
	    $row = $fetch->fetch_assoc();

        $list = array();
        $list['property_id'] = -1;
        $list['property_name'] = "Home";
        $list['property_address'] = "Home";
        $list['property_radius'] = $row['user_radius'];

        $coordinates = explode(",",$row['user_resident_coordinates']);

        $list['property_lat'] = $coordinates[0];
        $list['property_lng'] = $coordinates[1];

    }else{
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
    }

	echo json_encode($list);

}

?>