<?php
include '../core/config.php';

$_SESSION['user']['id'] = 1;
$_SESSION['user']['name'] = "Onir C. Arton";
$_SESSION['user']['category'] = "Residents";


header("location:../index.php");
