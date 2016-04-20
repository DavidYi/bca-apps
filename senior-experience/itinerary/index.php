<?php
/**
 * Created by PhpStorm.
 * User: macbook
 * Date: 1/5/16
 * Time: 2:04 PM
 */

require_once("../util/main.php");
require_once("../../shared/model/user_db.php");
require_once("../model/signups_db.php");
require_once ("../model/senior/presentations_db.php");

verify_logged_in();

$action = filter_input(INPUT_GET, 'action');
if (isset($action) and ($action == "logout")) {
    session_destroy();
    header("Location: ../index.php");
}


$signup_dates = get_signup_dates_by_grade($user->usr_grade_lvl);
$sessions = get_sessions_by_user($user->usr_id);
//
// Check if the user has mentors for all of the sessions.
//
// $registration_complete = true;
foreach ($sessions as $session) {
    if (empty($session['mentor_last_name'])) {
        $registration_complete = false;
        break;
    }
}

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

include ("view.php");
exit(); ?>