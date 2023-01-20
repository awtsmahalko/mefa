<?php
include '../core/config.php';
$Auth = new Authentication();
$Auth->inputs = $_POST;

$response = $Auth->recover();
echo $response;
// if ($response == 1) {
// 	$_SESSION['user'] = $Auth->session;
// 	header("location:../index.php");
// } else {
// 	$_SESSION['login_error'] = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert"><button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button><strong>Error - </strong> Credentials does not match to our records.</div>';
// 	$_SESSION['login'] = $Auth->old;
// 	header("location:../authentication.php");
// }
