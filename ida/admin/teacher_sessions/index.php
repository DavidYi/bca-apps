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
        
        $teacherList = $_POST['hdUserID'];
        $s1Original = $_POST['hdSes1'];
        $s2Original = $_POST['hdSes2'];
        $s1Choice = $_POST['session1'];
        $s2Choice = $_POST['session2'];
        if($choice == "Update Teachers"){
            update_all_teacher_sessions($teacherList, $s1Original, $s1Choice, $s2Original, $s2Choice);
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