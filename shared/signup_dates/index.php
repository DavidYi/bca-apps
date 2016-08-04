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
        $signups = get_signup_dates();
        
        include(__DIR__ . "/view.php");
        break;
    case 'update_signup_dates':
        $choice = filter_input(INPUT_POST, 'choice');


        if($choice == "Update Dates"){
            $gradeList = $_POST['hdGrade'];
            $modeList = $_POST['hdMode'];
            $startList = $_POST['start'];
            $endList = $_POST['end'];
            update_signup_dates($gradeList, $modeList, $startList, $endList);
        }

        header("Location: ..");
        exit();
        break;

    default:
        display_error('Unknown action: ' . $action);
        exit();
        break;
}
?>