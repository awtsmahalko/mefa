<?php

function getCurrentDate(){
	ini_set('date.timezone','UTC');
	//error_reporting(E_ALL);
	date_default_timezone_set('UTC');
	$today = date('H:i:s');
	$system_date = date('Y-m-d H:i:s', strtotime($today)+28800);
	return $system_date;
}

function getUser($id){
	global $mysqli_connect;

	$fetch = $mysqli_connect->query("SELECT * from tbl_users where user_id='$id' ");
	$row = $fetch->fetch_array();
	$user_name = $row['user_fullname'];

	return $user_name;
}

function timeago($date) {
	$timestamp = strtotime($date);	
	
	$strTime = array("second", "minute", "hour", "day", "month", "year");
	$length = array("60","60","24","30","12","10");

	$currentTime = strtotime(getCurrentDate());
	if($currentTime >= $timestamp) {
		 $diff     = $currentTime - $timestamp;
		 for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
		 $diff = $diff / $length[$i];
		 }

		 $diff = round($diff);
		 return $diff . " " . $strTime[$i] . "(s) ago ";
	}
 }

 function get_time_ago($date)
{
	$time_stamp = strtotime($date);
    $time_difference = strtotime(getCurrentDate()) - $time_stamp;

    if ($time_difference >= 60 * 60 * 24 * 365.242199)
    {
        /*
         * 60 seconds/minute * 60 minutes/hour * 24 hours/day * 365.242199 days/year
         * This means that the time difference is 1 year or more
         */
        return get_time_ago_string($time_stamp, 60 * 60 * 24 * 365.242199, 'year');
    }
    elseif ($time_difference >= 60 * 60 * 24 * 30.4368499)
    {
        /*
         * 60 seconds/minute * 60 minutes/hour * 24 hours/day * 30.4368499 days/month
         * This means that the time difference is 1 month or more
         */
        return get_time_ago_string($time_stamp, 60 * 60 * 24 * 30.4368499, 'month');
    }
    elseif ($time_difference >= 60 * 60 * 24 * 7)
    {
        /*
         * 60 seconds/minute * 60 minutes/hour * 24 hours/day * 7 days/week
         * This means that the time difference is 1 week or more
         */
        return get_time_ago_string($time_stamp, 60 * 60 * 24 * 7, 'week');
    }
    elseif ($time_difference >= 60 * 60 * 24)
    {
        /*
         * 60 seconds/minute * 60 minutes/hour * 24 hours/day
         * This means that the time difference is 1 day or more
         */
        return get_time_ago_string($time_stamp, 60 * 60 * 24, 'day');
    }
    elseif ($time_difference >= 60 * 60)
    {
        /*
         * 60 seconds/minute * 60 minutes/hour
         * This means that the time difference is 1 hour or more
         */
        return get_time_ago_string($time_stamp, 60 * 60, 'hour');
    }
    else
    {
        /*
         * 60 seconds/minute
         * This means that the time difference is a matter of minutes
         */
        return get_time_ago_string($time_stamp, 60, 'minute');
    }
}

function get_time_ago_string($time_stamp, $divisor, $time_unit)
{
    $time_difference = strtotime(getCurrentDate()) - $time_stamp;
    $time_units      = floor($time_difference / $divisor);

    settype($time_units, 'string');

    if ($time_units === '0')
    {
        return 'less than 1 ' . $time_unit . ' ago';
    }
    elseif ($time_units === '1')
    {
        return '1 ' . $time_unit . ' ago';
    }
    else
    {
        /*
         * More than "1" $time_unit. This is the "plural" message.
         */
        // TODO: This pluralizes the time unit, which is done by adding "s" at the end; this will not work for i18n!
        return $time_units . ' ' . $time_unit . 's ago';
    }
}


function emailSender($user_email, $user_otp)
{
    $to = $user_email;
    $subject = "RTFAA: Reset Password";

    $message = "
            <html>
            <head>
            <title>RTFAA: Reset Password</title>
            </head>
            <body>
            <p>Your OTP is : <b>$user_otp</b></p>
            </body>
            </html>
            ";

    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // More headers
    // $headers .= 'From: <webmaster@example.com>' . "\r\n";
    // $headers .= 'Cc: myboss@example.com' . "\r\n";

    mail($to, $subject, $message, $headers);
}

function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>