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

    default:
        echo('Unknown account action: ' . $action);
        break;

}



include("view.php");

?>
