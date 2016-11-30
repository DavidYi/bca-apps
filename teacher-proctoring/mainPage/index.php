<?php
/**
 *
 * Created by PhpStorm.
 * User: macbook
 * Date: 1/05/16
 * Time: 2:04 PM
 *
 */

require_once("../util/main.php");
require_once("../model/teacher_db.php");

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'list_selected_tests';
    }
}

verify_logged_in();




if (isset($action) and ($action == "logout")) {
    if (isset($_SESSION['prev_usr_id'])) {
        $_SESSION['user'] = User::getUserByUsrId($_SESSION['prev_usr_id']);
        unset($_SESSION['prev_usr_id']);
        header("Location: ../admin/index.php");
    } else {
        session_destroy();
        header("Location: ../index.php");
    }
}


switch ($action) {

    case 'list_selected_tests':
        $filter_past = filter_input(INPUT_POST, 'past_button');
        $past_num = $_SESSION['filter_past'] ? 1 : 0;
        
        $count = get_count($user->usr_id);
        $testSelectedList = get_selected_test_list2($user->usr_id, $past_num);

        include ('./view.php');
        break;

    case 'show_itinerary':
        header("Location: ../itinerary");
        break;


    default:
        echo('Unknown account action: ' . $action);
        break;
}

exit();