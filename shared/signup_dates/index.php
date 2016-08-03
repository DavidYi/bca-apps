<?php

require_once (__DIR__ . '/../model/signup_dates_db.php');

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
        $grade9 = get_signup_dates_by_grade(9);
        $grade10 = get_signup_dates_by_grade(10);
        $grade11 = get_signup_dates_by_grade(11);
        $grade12 = get_signup_dates_by_grade(12);
        include(__DIR__ . "/view.php");
        break;
    case 'modify_dates':
        $choice = filter_input(INPUT_POST, 'choice');
        if($choice == "Modify Dates"){
            $start9 = filter_input(INPUT_POST, 'start_9');
            $start10 = filter_input(INPUT_POST, 'start_10');
            $start11 = filter_input(INPUT_POST, 'start_11');
            $start12 = filter_input(INPUT_POST, 'start_12');
            $end9 = filter_input(INPUT_POST, 'end_9');
            $end10 = filter_input(INPUT_POST, 'end_10');
            $end11 = filter_input(INPUT_POST, 'end_11');
            $end12 = filter_input(INPUT_POST, 'end_12');
            update_signup_dates ($start9, $end9, $start10, $end10, $start11, $end11, $start12, $end12);
        }
        header("Location: ..");
        break;
    default:
        display_error('Unknown account action: ' . $action);
        exit();
        break;
}
?>