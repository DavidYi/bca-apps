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
$start_date = date('h:i A', strtotime($signup_dates['start']));
$start_date .= " on ";
$start_date .= date('M d', strtotime($signup_dates['start']));
$end_date = date('h:i A', strtotime($signup_dates['end']));
$end_date .= " on ";
$end_date .= date('M d', strtotime($signup_dates['end']));

include ("itinerary/view.php");
exit();