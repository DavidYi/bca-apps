<?php
/**
 * Created by PhpStorm.
 * User: macbook
 * Date: 12/16/15
 * Time: 10:05 AM
 */

require_once('../util/main.php');
require_once('model/presentations_db.php');
require_once('model/signups_db.php');

$user = get_user($_SESSION['usr_id']);
$currentSession = filter_input(INPUT_GET, 'session');
if ($currentSession < 1 || $currentSession > 4) {
    $currentSession = 1;
}
$sort_by = filter_input(INPUT_GET, "sort");

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
$is_changing = $is_enrolled;
if ($action == "register") {
    if (!($current_date < $start_date || $current_date > $end_date)) {
        $presentations = get_presentation_list($currentSession, $sort_by);
        include("view.php");
    } else {
        echo ("<h1>It is not time to enroll.</h1>");
    }
}  else if ($action == "commit") {
    $pres_id = filter_input(INPUT_GET, 'pres_id');
    $presentation = Presentation::getPresentation($pres_id);

    // Error -- not time to sign up.
    if ($current_date < $start_date || $current_date > $end_date) {
        if (!$presentation->has_space()) {
            display_error("It is not currently time to enroll.  Please check the enrollment dates.");
            exit();
        }
    }

    // Error -- presentation full.
    else if (!$presentation->has_space()) {
        display_error("The presentation you selected is already full.  Please select another.");
        exit();
    }

    // All good -- add the presentation!
    else {
        $presentation->addPresForUser($user['usr_id']);
        header("Location: ../itinerary/");
    }
}
exit();

