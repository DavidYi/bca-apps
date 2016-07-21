<?php

include('../util/main.php');
require_once('../model/times_db.php');
require_once('../model/student_db.php');

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'list_options';
    }
}

$usr_id = get_usr_id($user->usr_first_name, $user->usr_last_name);

// get the strings telling the available mods for each day
$time_strings = get_time_strings($usr_id);

// get the courses the student is interested in
$courses = get_courses($usr_id);

switch ($action) {
    
    case 'submit':
        
        echo'test';


    case 'list_options':
        include('./view.php');
        break;
    case 'delete_course':
        $course_id = $_GET["course_id"];
        student_delete_course($usr_id, $course_id);
        include('./view.php');
        break;
    case 'modify_courses':
        header('Location: ./courses/index.php');
        exit();
        break;
    case 'modify_times':
        header('Location: ../teacher/availability/index.php?teacher=0');
        include('./times/view.php');
        break;
    case 'logout':
        echo "will make a logout page later";
        header ('Location: ./courses/index.php');
        break;
    case 'back':
        include('./view.php');
        break;

    default:
        include('./view.php');
        break;
}
?>
