<?php
/**
 * Created by PhpStorm.
 * User: matth
 * Date: 7/13/2016
 * Time: 11:51 AM
 */
require_once(__DIR__ . "/../../util/main.php");
require_once(__DIR__ . "/../../model/teacher_db.php");

$course_id = filter_input(INPUT_GET, 'course_id');
$course = get_course_by_course_id($course_id);

// Make sure users don't try to access courses that are not theirs.
if (($user->getRole($app_cde) != 'ADM') && ($course["teacher_id"] !== $user->usr_id)){
    log_error ("Permission exception in course_signup_matrix.  User id:" . $user->usr_id . "; Course ID: " . $course_id);
    display_user_message("Permission denied.", '/' . $app_url_path . '/teacher');
}

$header_array = get_course_signup_matrix_heading($course_id);
$body_array = get_course_signup_matrix_body($course_id);

include "view.php";
