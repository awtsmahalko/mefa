<?php

function getCurrentDate()
{
	ini_set('date.timezone', 'UTC');
	//error_reporting(E_ALL);
	date_default_timezone_set('UTC');
	$today = date('H:i:s');
	$system_date = date('Y-m-d H:i:s', strtotime($today) + 28800);
	return $system_date;
}

function getUser($id)
{
	global $mysqli_connect;

	$fetch = $mysqli_connect->query("SELECT * from tbl_users where user_id='$id' ");
	$row = $fetch->fetch_array();
	$user_name = $row['user_fname'] . ' ' . $row['user_mname'] . ' ' . $row['user_lname'];

	return $user_name;
}
