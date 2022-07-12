<?php
include '../core/config.php';

$ClassName = $_REQUEST['q'];
$Method = $_REQUEST['m'];

$Intance = new $ClassName;
$Intance->inputs = $_POST;
echo $Intance->$Method();
