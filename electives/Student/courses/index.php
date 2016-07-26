<?php
/**
 * Created by PhpStorm.
 * User: macbook
 * Date: 1/5/16
 * Time: 2:04 PM
 */

require_once("../../util/main.php");
require_once("../../model/teacher_db.php");
require_once("../../model/student_db.php");
require_once("../../model/times_db.php");


verify_logged_in();

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'default';
    }
}

$usr_id = get_usr_id($user->usr_first_name, $user->usr_last_name);

$courseList = get_course_list_for_student($usr_id);

switch ($action) {
    case "update_courses":
        reset_courses_for_student($usr_id);
        $chosen_courses = $_POST["checkbox"];
        foreach($chosen_courses as $course_id) {
            student_add_course($usr_id, $course_id);
        }
        header("Location: ../index.php");
        break;
    default:
        include ("./view.php");
        break;
}

exit();