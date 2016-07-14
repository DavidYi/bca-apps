<?php

require_once('../util/main.php');

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'date_select';
    }
}

verify_admin();

switch ($action) {
    case 'date_select':
        include("./view.php");
        break;
    default:
        display_error('Unknown account action: ' . $action);
        exit();
        break;
}
?>