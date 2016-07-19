<?php
require_once("../../util/main.php");
require_once("../../model/teacher_db.php");

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = '';
    }
}


switch ($action) {

    case 'list_teacher_status':
        $teacher_status_list = get_teacher_status();
        include ("view.php");
        break;

    default:
        display_error('Unknown teacher action: ' . $action);
        break;
}



?>