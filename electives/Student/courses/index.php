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
$available_times = get_times($usr_id);

// true:student, false:teacher
$student_or_teacher = ($user->usr_type_cde == 'STD') ? true : false;

// If the user is being mimicked by an admin, use that id as the updt id.
// Otherwise, use the id of the current user.
$updateById = (isset($_SESSION['prev_usr_id'])) ? $_SESSION['prev_usr_id'] : $user->usr_id;

switch ($action) {
    case "update_courses":
        reset_courses_for_student($usr_id);
        $chosen_courses = $_POST["checkbox"];
        foreach($chosen_courses as $course_id) {
            student_add_course($usr_id, $course_id, $updateById);
        }
        if ($student_or_teacher) {
            header("Location: ../index.php");
        } else {
            header("Location: ../../teacher/index.php");
        }
        break;
    case "sort_courses_by_name":
        // sorting by course_name is the default
        $courseList = get_course_list_for_student($usr_id);
        include("./view.php");
        break;
    case "sort_courses_by_teacher":
        $courseList = get_course_list_for_student($usr_id, "teacher");
        include("./view.php");
        break;
    case "sort_courses_by_interest":
        // !enrolled will make the enrolled courses to be listed first
        $courseList = get_course_list_for_student($usr_id, "!enrolled");
        include("./view.php");
        break;
    default:
        $courseList = get_course_list_for_student($usr_id);
        include ("./view.php");
        break;
}

exit();