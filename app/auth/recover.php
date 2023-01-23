<?php
include '../core/config.php';
$Auth = new Authentication();
$Auth->inputs = $_POST;

$response = $Auth->recover();
$recover_error = '';
if ($response != 1) {
	$recover_error = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert"><button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button><strong>Error - </strong> Credentials does not match to our records.</div>';
}
$_SESSION['recover_error'] = $recover_error;
$_SESSION['recover'] = $Auth->old;
header("location:../authentication.php");
// $to = "eduard16carton@gmail.com";
// $subject = "Test email from localhost";
// $message = "This is a test email sent from a localhost server using PHP.";
// $headers = "From: eduard30carton@gmail.com" . "\r\n" .
// 	"Reply-To: eduard30carton@gmail.com" . "\r\n" .
// 	"X-Mailer: PHP/" . phpversion();

// mail($to, $subject, $message, $headers);
