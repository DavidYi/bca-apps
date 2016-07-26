<?php
require_once("../../util/main.php");
require_once("../../model/teacher_db.php");

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'list_upcoming_tests';
    }
}
switch ($action) {

    case 'list_upcoming_tests':
        $upcoming_tests = list_upcoming_tests();
        include("view.php");
        break;

    case 'send_email':
        include('admin_email_script.php');
        break;

    default:
        echo('Unknown account action: ' . $action);
        break;

}


?>
