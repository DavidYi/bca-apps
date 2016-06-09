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
$course_name = $_GET["course_name"];

switch ($action) {
    case 'default':
        include("view.php");
        break;
    case 'edit_course':
        $choice = filter_input(INPUT_POST, 'choice');
        if ($choice == "Edit Course") {
            $new_course_name = $_POST["new_course_name"];
            $new_course_dessc = $_POST["new_course_desc"];

            edit_course($course_name, $new_course_name, $new_course_desc);
        } else {
            header('Location: ..');
        }
        break;
}
