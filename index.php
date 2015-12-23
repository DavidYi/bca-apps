<?php
/**
 * Created by PhpStorm.
 * User: macbook
 * Date: 12/16/15
 * Time: 10:05 AM
 */

require_once('util/main.php');
require_once('model/presentations_db.php');
require_once ('model/signups_db.php');

$user = get_user($_SESSION['usr_id']);
$currentSession = filter_input(INPUT_GET, 'session');
if ($currentSession < 1 || $currentSession > 4) {
    $currentSession = 1;
}

$presentations = get_presentation_list($currentSession);

$pres_enrolled = get_presentation_by_user($user['usr_id'], $currentSession);
$is_enrolled = FALSE;

if ($pres_enrolled != NULL) {
    $is_enrolled = TRUE;
}

$signup_dates = (get_signup_dates_by_class_year($user['usr_class_year']));
$start_date = strtotime($signup_dates['start']);
$end_date = strtotime($signup_dates['end']);
$current_date = strtotime(date("Y-m-d h:i:sa"));


$action = filter_input(INPUT_GET, 'action');
$is_changing = false;
if ($action == "register") {
    if (!($current_date < $start_date || $current_date > $end_date)) {
        include("view.php");
    } else {
        echo ("<h1>It is not time to enroll.</h1>");
    }
} else if ($action == "change") {
    if (!($current_date < $start_date || $current_date > $end_date)) {
        $is_changing = true;
        include("view.php");
    } else {
        echo ("<h1>It is not time to enroll.</h1>");
    }
} else {
    include("home.php");
}

exit();

