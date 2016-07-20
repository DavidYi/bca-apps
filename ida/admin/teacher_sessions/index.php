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
//    case 'modify_admin':
//        $choice = filter_input(INPUT_POST, 'choice');
//        if($choice == "Add Admin"){
//            $usr_id = filter_input(INPUT_POST, 'user_drop');
//            $usr_role_cde = filter_input(INPUT_POST, 'role_drop');
//            add_admin($usr_id, $app_cde, $usr_role_cde);
//        }
//        $assigned_roles = get_assigned_roles();
//        $users = get_users();
//        $roles = get_roles();
//        include("./view.php");
//        break;
    default:
        display_error('Unknown account action: ' . $action);
        exit();
        break;
}
?>