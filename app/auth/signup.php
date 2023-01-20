<?php

include '../core/config.php';

$Auth = new Authentication();
$Auth->inputs = $_POST;
$response = $Auth->signup();
if ($response == 1) {
    $_SESSION['user'] = $Auth->session;
    header("location:../index.php");
} else if ($response == 2) {
    $_SESSION['signup_error'] = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert"><button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button><strong>Error - </strong>Username is already taken.</div>';
    $_SESSION['signup'] = $Auth->old;
    header("location:../authentication.php");
} else if ($response == 3) {
    $_SESSION['signup_error'] = '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert"><button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button><strong>Error - </strong>Email is already taken.</div>';
    $_SESSION['signup'] = $Auth->old;
    header("location:../authentication.php");
} else {
    header("location:../authentication.php");
}
