<?php
/**
 * Created by PhpStorm.
 * User: macbook
 * Date: 12/16/15
 * Time: 10:05 AM
 */

require_once('../util/main.php');
require_once("../../shared/model/user_db.php");
require_once('../model/presentations_db.php');
require_once('../model/signup_dates_db.php');

verify_logged_in();

$currentSession = filter_input(INPUT_GET, 'session');
if ($currentSession < 1 || $currentSession > 4) {
    $currentSession = 1;
}
$sort_by = filter_input(INPUT_GET, "sort");

$pres_enrolled = get_presentation_by_user($user->usr_id, $currentSession);
$is_enrolled = FALSE;

if ($pres_enrolled != NULL) {
    $is_enrolled = TRUE;
}

$sort_order = filter_input(INPUT_GET, 'order');
if ($sort_order == NULL) {
    $sort_order = 1;
}

$signup_dates = (get_signup_dates_by_grade($user->usr_grade_lvl));
$start_date = strtotime($signup_dates['start']);
$end_date = strtotime($signup_dates['end']);

date_default_timezone_set('America/New_York');
$current_date = time();

$action = filter_input(INPUT_GET, 'action');
$id = 0;
$register_id = 0;
$is_changing = $is_enrolled;
if ($action == "register") {
    if (!($current_date < $start_date || $current_date > $end_date) || isset($_SESSION['prev_usr_id'])) {
        $presentations = get_presentation_list($currentSession, $sort_by, $sort_order);
        include("view.php");
    } else {
        display_user_message("It's not time to enroll yet", "/" . $app_url_path . "/itinerary");
    }
}  else if ($action == "commit") {
    $pres_id = filter_input(INPUT_GET, 'pres_id');
    $presentation = Presentation::getPresentation($pres_id);

    // Error -- not time to sign up.
    if (!isset($_SESSION['prev_usr_id'])) {
        if ($current_date < $start_date || $current_date > $end_date) {
            display_user_message("It is not currently time to enroll.  Please check the enrollment dates.", "/" . $app_url_path . "/itinerary");
            exit();
        } // Error -- presentation full.
        else if (!$presentation->has_space()) {
            display_user_message("The presentation you selected is already full.  Please select another.", "/" . $app_url_path . "/itinerary");
            exit();
        }
    }

    // All good -- add the presentation!
//    echo "add";
    $presentation->addPresForUser($user->usr_id);
    header("Location: ../itinerary/");
}
exit();

