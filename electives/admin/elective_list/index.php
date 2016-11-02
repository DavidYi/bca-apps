<?php
/**
 * Created by PhpStorm.
 * User: matth
 * Date: 7/27/2016
 * Time: 9:06 AM
 */
require_once("../../util/main.php");
require_once("../../model/admin_db.php");
require_once("../../model/teacher_db.php");



$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'default';
    }
}

switch ($action) {
    case "sort_electives":
        $sort_by = filter_input(INPUT_GET, 'sort');
        if ($sort_by == NULL) {
            $sort_by = 1;
        }

        $sort_order = filter_input(INPUT_GET, 'order');
        if ($sort_order == NULL) {
            $sort_order = 0;
        }
        $elective_list = get_elective_list($sort_by, $sort_order);
        include('./view.php');
        break;

    case "delete_course":
        $course_id = $_GET['course_id'];
        delete_course($course_id);
        $elective_list = get_elective_list(1, 0);
        include('./view.php');
        break;

    case "edit":
        $course_id = $_GET['course_id'];
        header("Location: edit/index.php?course_id=" . $course_id);
        break;

    default:
        $sort_order = 1;
        $sort_by = 1;
        $elective_list = get_elective_list(1, 0);
        include('./view.php');
        break;
}

?>