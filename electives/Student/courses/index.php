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

verify_student();

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'default';
    }
}


$usr_id = $user->usr_id;
$available_times = get_times($usr_id);

// true:    student, false:teacher
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
    case "sort_courses":
        // sorting by course_name is the default
        $sort_by = filter_input(INPUT_GET, 'sort');
        if ($sort_by == NULL) {
            $sort_by = 0;
        }

        $sort_order = filter_input(INPUT_GET, 'order');
        if ($sort_order == NULL) {
            $sort_order = 0;
        }
        $courseList = get_course_list_for_student($usr_id, $sort_by, $sort_order);
        include("./view.php");
        break;
    default:
        $courseList = get_course_list_for_student($usr_id, 0, 0);
        $sort_by = 0;
        $sort_order = 0;
        include ("./view.php");
        break;
}

exit();