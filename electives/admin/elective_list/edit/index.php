<?php
/**
 * Created by PhpStorm.
 * User: matth
 * Date: 8/2/2016
 * Time: 10:07 AM
 */
require_once("../../../util/main.php");
require_once("../../../model/admin_db.php");
require_once("../../../model/teacher_db.php");

verify_admin();
$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'default';
    }
}

switch ($action) {
    case "edit":
        $name = $_POST['name'];
        $desc = $_POST['desc'];
        $teacher = $_POST['teacher'];
        $course_id = $_POST['course_id'];
        $active = $_POST['active'];

        if ($active === 'Yes')
            $active = 1;
        else
            $active = 0;

        admin_edit_course($course_id, $teacher, $name, $desc, $active);
        header("Location: ../index.php");
        break;
    
    default:
        $course_id = filter_input(INPUT_GET, 'course_id');
        $teacher_list = admin_get_teachers();
        $course_info = get_course_info($course_id);
        $teacher_id = $course_info['teacher_id'];
        $course_name = $course_info['course_name'];
        $course_desc = $course_info['course_desc'];
        $active = $course_info['active'];

        include("./view.php");
        break;
}