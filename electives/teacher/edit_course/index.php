<?php
/**
 * Created by PhpStorm.
 * User: matth
 * Date: 6/8/2016
 * Time: 9:27 AM
 */
require_once(__DIR__ . "/../../util/main.php");
require_once(__DIR__ . "/../../model/teacher_db.php");

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'default';
    }
}

switch ($action) {
    case 'default':
        $course_name = $_GET["course_name"];
        $course_desc = $_GET["course_desc"];
        $course_id = $_GET["course_id"];
        include("view.php");
        break;
    case 'edit_course':
        $choice = filter_input(INPUT_POST, 'choice');
        if ($choice == "Edit Course") {
            $new_course_name = $_POST["new_course_name"];
            $new_course_desc = $_POST["new_course_desc"];
            $course_id = $_POST["course_id"];

            edit_course($course_id, $new_course_name, $new_course_desc);
            header('Location: ..');
        } else {
            header('Location: ..');
        }
        break;
}
