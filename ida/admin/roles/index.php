<?php

require_once('../../util/main.php');
//require_once('../../model/admin_db.php');

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'list_roles';
    }
}

verify_admin();

switch ($action) {
    case 'list_roles':
        include("./view.php");
        break;
//    case 'modify_dates':
//        $choice = filter_input(INPUT_POST, 'choice');
//        if($choice == "Modify Dates"){
//            $start9 = filter_input(INPUT_POST, 'start_9');
//            $start10 = filter_input(INPUT_POST, 'start_10');
//            $start11 = filter_input(INPUT_POST, 'start_11');
//            $start12 = filter_input(INPUT_POST, 'start_12');
//            $end9 = filter_input(INPUT_POST, 'end_9');
//            $end10 = filter_input(INPUT_POST, 'end_10');
//            $end11 = filter_input(INPUT_POST, 'end_11');
//            $end12 = filter_input(INPUT_POST, 'end_12');
//            update_signup_dates ($start9, $end9, $start10, $end10, $start11, $end11, $start12, $end12);
//        }
//        header("Location: ..");
//        break;
    default:
        display_error('Unknown account action: ' . $action);
        exit();
        break;
}
?>