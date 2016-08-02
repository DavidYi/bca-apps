<?php
/**
 * Created by PhpStorm.
 * User: matth
 * Date: 7/28/2016
 * Time: 10:50 AM
 */
require_once("../../../util/main.php");
require_once("../../../model/admin_db.php");
require_once("../../../model/teacher_db.php");


$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'default';
    }
}

switch ($action) {
    case "add_course":
        $choice = filter_input(INPUT_POST, 'choice');
        if ($choice == "Back") {
            header("Location: ../index.php");
            exit();
            break;
        }

        $course_name = $_POST['course_name'];
        $course_desc = $_POST['course_desc'];
        $teacher = $_POST['teacher'];

        if (empty($course_name) || empty($course_desc) || $teacher == 'none') {
            echo "<script>alert('Please complete all fields');</script>";
            $teacher_list = admin_get_teachers();
            include('./view.php');
            break;
        }
        
        add_course($course_name, $course_desc, $teacher);
        header("Location: ../index.php");
        exit();
        break;
    default:
        $teacher_list = admin_get_teachers();
        include("./view.php");
        break;
}