<?php
include '../core/config.php';

$_SESSION['user']['id'] = 1;
$_SESSION['user']['name'] = "Eduard Rino Q. Carton";

header("location:../index.php");
