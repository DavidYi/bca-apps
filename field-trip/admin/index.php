<?php
include('../util/main.php');

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'list_options';
    }
}
//some change
verify_admin();

switch ($action) {
    case 'list_options':
        include('./view.php');
        break;
    default:
        display_error('Unknown account action: ' . $action);
        exit();
        break;
}
?>

