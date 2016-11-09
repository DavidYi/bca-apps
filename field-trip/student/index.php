<?php

include('../util/main.php');
require_once('../model/student_db.php');

verify_student();

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'default';
    }
}

include('./view.php');

?>
