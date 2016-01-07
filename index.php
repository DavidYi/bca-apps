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
$id = 0;
$register_id = 0;
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
} else if ($action == "commit") {
    $pres_id = filter_input(INPUT_GET, 'pres_id');

    // Why run this query when we have the value in the get request? To ensure consistency in case
    // of any discrepancies between the pres_id and ses_id in the GET.
    // We are deleting presentations based upon the ses_id and adding using the pres_id.
    // $currentSession = get_session_for_presentation($pres_id);

    if ($current_date < $start_date || $current_date > $end_date) {
        echo("<h1>It is not time to enroll.</h1>");
    }
    else if (presentation_has_space($pres_id) == false) {
        echo("<h1>Presentation is full.</h1>");
    }
    else {
        if ($is_enrolled) {
            echo ("Deleting: pres: " . $pres_enrolled['pres_id'] . " for user:".$user['usr_id']);
            delete_presentation_for_user($pres_enrolled['pres_id'], $user['usr_id']);
        }

        echo ("Adding: pres: " . $pres_id . " for user:".$user['usr_id']);
        add_presentation_for_user ($pres_id, $user['usr_id']);
//        exit();
//        joinSessionPresentation ($currentSession, $pres_id, $user['usr_id']);

        header("Location: itinerary/");
    }
}
exit();

