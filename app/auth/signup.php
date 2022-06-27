<?php
include '../core/config.php';

$_SESSION['user']['id'] = 1;
$_SESSION['user']['name'] = $_POST['user_fullname'];
$_SESSION['user']['category'] = "Resident";

header("location:../index.php");
