<?php
require_once ("../../util/main.php");
require_once (__DIR__ . "/../../../shared/model/user_db.php");
require_once (__DIR__ . "/../../../shared/model/database.php");
require_once("../../model/admin_db.php");
require_once("../../model/student_db.php");


$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'show_delete';
    }
}

switch ($action) {

    case 'show_delete':

        include ('view.php');
        break;

    //Everything below this line feels dangerous

    case "clear_student_availability":
        clear_student_availability();
        include ('view.php');
        break;

    case "clear_student_interest":
        clear_student_interest();
        include ('view.php');
        break;

    case "clear_teacher_availability":
        clear_teacher_availability();
        include ('view.php');
        break;

    case "clear_all_courses":
        clear_all_courses();
        include ('view.php');
        break;

    default:
        echo ("No action found.");
        break;
}



?>