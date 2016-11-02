<?php
require_once ("../../util/main.php");
require_once("../../model/admin_db.php");
require_once("../../model/student_db.php");

verify_admin();

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

    //Everything below this line is dangerous

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

    case "inactivate_all_courses":
        inactivate_all_courses();
        include ('view.php');
        break;

    default:
        echo ("No action found.");
        break;
}



?>