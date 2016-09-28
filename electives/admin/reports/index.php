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
        $action = 'show_availability_matrix';
    }
}

switch ($action) {

    case 'show_availability_matrix':
        $availability_list = get_best_course_availability();

        include('view.php');
        break;
}
?>