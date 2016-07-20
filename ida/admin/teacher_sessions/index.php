<?php

require_once('../../util/main.php');
require_once('../../model/teacher_sessions_db.php');

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'display_page';
    }
}

verify_admin();

switch ($action) {
    case 'display_page':
        $teachers = get_teachers();
        $session1 = get_pres_list(1);
        $session2 = get_pres_list(2);
        include("./view.php");
        break;
    case 'update_sessions':
        $choice = filter_input(INPUT_POST, 'choice');
        if($choice == "Back"){
            header("Location: ..");
        }
        $teachers = get_teachers();
        $session1 = get_pres_list(1);
        $session2 = get_pres_list(2);
        include("./view.php");
        break;
    default:
        display_error('Unknown account action: ' . $action);
        exit();
        break;
}
?>