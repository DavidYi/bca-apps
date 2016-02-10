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

$action = filter_input(INPUT_GET, 'action');
if (isset($action) and ($action == "logout")) {
    session_destroy();
    header("Location: ../index.php");
}

$user = get_user($_SESSION['usr_id']);
$sessions = get_sessions_by_user($user['usr_id']);

//
// Check if the user has mentors for all of the sessions.
//
$registration_complete = true;
foreach ($sessions as $session) {
    if (empty($session['mentor_last_name'])) {
        $registration_complete = false;
        break;
    }
}

$signup_dates = get_signup_dates_by_class_year($user['usr_class_year']);

date_default_timezone_set('America/New_York');
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
exit(); ?>