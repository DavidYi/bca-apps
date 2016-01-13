<?php
/**
 * Created by PhpStorm.
 * User: macbook
 * Date: 1/5/16
 * Time: 2:04 PM
 */

require_once("../util/main.php");
require_once("model/presentations_db.php");
require_once ("model/signups_db.php");

$user = get_user($_SESSION['usr_id']);
$sessions = get_sessions_by_user($user['usr_id']);

$signup_dates = get_signup_dates_by_class_year($user['usr_class_year']);

$currentTime = time();
$startTime = strtotime($signup_dates['start']);
$endTime = strtotime($signup_dates['end']);
$startTimeFormatted = date('M d, g:i  a', $startTime);
$endTimeFormatted = date('M d, g:i  a', $endTime);

if (($currentTime > $startTime) and ($currentTime < $endTime))
    $registrationOpen = true;
else
    $registrationOpen = false;

include ("itinerary/view.php");
exit();