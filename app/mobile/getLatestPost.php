<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once '../core/config.php';

$data = json_decode(file_get_contents("php://input"));
   // $r_id = $mysqli_connect->real_escape_string($data->r_id);
$fetch = $mysqli_connect->query("SELECT * FROM tbl_posts");
$response = array();
while ($row = $fetch->fetch_array()) {
    $list = array();
    $list['id'] = $row['post_id'];
    $list['user_id'] = $row['user_id'];
    $list['post_title'] = $row['post_title'];
    $list['post_content'] = $row['post_content'];
    $list['post_date'] = $row['post_date'];
    array_push($response, $list);
}

echo json_encode($response);
?>