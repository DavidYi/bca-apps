<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 2/17/2016
 * Time: 10:33 AM
 */
require_once('../util/main.php');
require_once("../../shared/model/user_db.php");
require_once('../model/presentations_db.php');

$user = get_user($_SESSION['usr_id'], 'CAR');
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

$sort_order = filter_input(INPUT_GET, 'order');
if ($sort_order == NULL) {
    $sort_order = 1;
}

$signup_dates = (get_signup_dates_by_class_year($user['usr_class_year']));
$start_date = strtotime($signup_dates['start']);
$end_date = strtotime($signup_dates['end']);

date_default_timezone_set('America/New_York');
$current_date = time();

$action = filter_input(INPUT_GET, 'action');
$id = 0;
$register_id = 0;
$is_changing = $is_enrolled;
if ($action == "register") {
    if (!($current_date < $start_date || $current_date > $end_date)) {
        $presentations = get_presentation_list($currentSession, $sort_by, $sort_order);
        include("view.php");
    } else {
        display_error("It's not time to enroll yet");
    }
}  else if ($action == "commit") {
    $pres_id = filter_input(INPUT_GET, 'pres_id');
    $presentation = Presentation::getPresentation($pres_id);

    // Error -- not time to sign up.
    if ($current_date < $start_date) {
        display_error("It is not time to enroll yet. It starts at " . date_format($start_date,'g:ia \o\n l jS F Y') . ".");
        exit();
    } else if ($current_date > $end_date){
        display_error("Sign up has ended.");
        exit();
    }

    // Error -- presentation full.
    else if (!$presentation->has_space()) {
        display_error("The presentation you selected is already full.  Please select another presentation.");
        exit();
    }

    // All good -- add the presentation!
    else {
        $presentation->addPresForUser($user['usr_id']);
        header("Location: ../itinerary/");
    }
}
exit();

