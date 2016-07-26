<?php

require_once('../../util/main.php');
require_once('../../model/workshop_admin_db.php');

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'time_select';
    }
}

verify_admin();

switch ($action) {
    case 'time_select':
        $session1 = get_session_times(1);
        $session2 = get_session_times(2);
        include("./view.php");
        break;
    case 'modify_times':
        $choice = filter_input(INPUT_POST, 'choice');
        if($choice == "Modify"){
            $start1 = filter_input(INPUT_POST, 'start1');
            $start2 = filter_input(INPUT_POST, 'start2');
            $end1 = filter_input(INPUT_POST, 'end1');
            $end2 = filter_input(INPUT_POST, 'end2');
            update_session_times ($start1, $end1, $start2, $end2);
        }
        header("Location: ..");
        break;
    default:
        display_error('Unknown account action: ' . $action);
        exit();
        break;
}
?>