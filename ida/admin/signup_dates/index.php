<?php

require_once('../../util/main.php');
require_once('../../model/signup_dates_db.php');

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
    case 'modify_dates':
        $choice = filter_input(INPUT_POST, 'choice');
        if($choice == "Modify Dates"){
            update_signup_dates ($_POST['start_9'], $_POST['end_9'], $_POST['start_10'], $_POST['end_10'], $_POST['start_11'], $_POST['end_11'], $_POST['start_12'], $_POST['end_12']);
        }
        header("Location: ..");
        break;
    default:
        display_error('Unknown account action: ' . $action);
        exit();
        break;
}
?>