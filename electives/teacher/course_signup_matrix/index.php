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
$header_array = get_course_signup_matrix_heading($course_id);
$body_array = get_course_signup_matrix_body($course_id);

include "view.php";
