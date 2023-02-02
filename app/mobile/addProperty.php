<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once 'core/config.php';

$data = json_decode(file_get_contents("php://input"));

if(isset($data->property_id) && !empty($data->property_id) ){
	$property_id = $mysqli_connect->real_escape_string($data->property_id);
    $property_name = $mysqli_connect->real_escape_string($data->property_name);
	$property_address = $mysqli_connect->real_escape_string($data->property_address);
	$property_lat = $mysqli_connect->real_escape_string($data->property_lat);
    $property_lng = $mysqli_connect->real_escape_string($data->property_lng);
    $user_id = $mysqli_connect->real_escape_string($data->user_id);
    $property_radius = $mysqli_connect->real_escape_string($data->property_radius);
    $property_coordinates = $property_lat . "," . $property_lng;

	$date = getCurrentDate();

    if($property_id > 0){
        // update
        $fetch_rows = $mysqli_connect->query("SELECT count(property_id) FROM `tbl_properties` WHERE property_name='$property_name' and property_address='$property_address' and user_id='$user_id' and property_id != '$property_id' ") or die(mysqli_error());
	    $rows = $fetch_rows->fetch_array();

        if($rows[0] > 0){
            echo -1;
        }else{
            
            $sql = $mysqli_connect->query("UPDATE `tbl_properties` SET `property_name`='$property_name',`property_coordinates`='$property_coordinates',`property_radius`='$property_radius',`property_address`='$property_address',`user_id`='$user_id',`date_added`='$date',`date_updated`='$date' WHERE property_id='$property_id' ") or die(mysql_error());

            if($sql){
                echo 1;
            }else{
                echo 0;
            }
        }

    }else{
        // add
        $property_code = generateRandomString(6);
        $sql = $mysqli_connect->query("INSERT INTO `tbl_properties`(`property_code`, `property_name`, `property_coordinates`, `property_radius`, `property_address`, `user_id`, `date_added`, `date_updated`) VALUES ('$property_code','$property_name','$property_coordinates','$property_radius','$property_address','$date')") or die(mysql_error());

        if($sql){
            echo 1;
        }else{
            echo 0;
        }
    }

	
    

	
}

?>