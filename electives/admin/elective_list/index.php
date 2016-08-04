<?php
/**
 * Created by PhpStorm.
 * User: matth
 * Date: 7/27/2016
 * Time: 9:06 AM
 */
require_once("../../model/admin_db.php");
require_once("../../model/teacher_db.php");

require_once("../../util/main.php");

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'default';
    }
}

switch ($action) {
    case "sort_by_elective":
        $elective_list = get_elective_list(1);
        include('./view.php');
        break;
    case "sort_by_num_students":
        $elective_list = get_elective_list(2);
        include('./view.php');
        break;
    case "delete_course":
        $course_id = $_GET['course_id'];
        delete_course($course_id);
        $elective_list = get_elective_list();
        include('./view.php');
        break;
    case "edit":
        $course_id = $_GET['course_id'];
        header("Location: edit/index.php?course_id=" . $course_id);
        break;
    default:
        $elective_list = get_elective_list();
        include('./view.php');
        break;
}

?>