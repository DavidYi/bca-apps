<?php
require_once("../../util/main.php");
require_once("../../model/teacher_db.php");

verify_test_admin();

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'list_teacher_status';
    }
}

////Thanks Brian ur d best
//
switch ($action) {

    case 'list_teacher_status':
        $sort_by = filter_input(INPUT_GET, 'sort');
        if ($sort_by == NULL) {
            $sort_by = 0;
        }

        $sort_order = filter_input(INPUT_GET, 'order');
        if ($sort_order == NULL) {
            $sort_order = 0;
        }

        $teacher_status_list = list_teacher_status($sort_by, $sort_order);



        break;

    default:
        echo('Unknown account action: ' . $action);
        break;

}



include("view.php");

?>