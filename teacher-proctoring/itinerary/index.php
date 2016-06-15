<?php
/**
 * Created by PhpStorm.
 * User: macbook
 * Date: 1/5/16
 * Time: 2:04 PM
 */

require_once("../util/main.php");
require_once("../model/teacher_db.php");

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'list_user_tests';
    }
}

if(!isset($_SESSION['filter_full']))
    $_SESSION['filter_full'] = false;

if(!isset($_SESSION['filter_past']))
    $_SESSION['filter_past'] = false;


switch ($action) {

    case 'change_user_tests':
        $changeTestList = filter_input(INPUT_POST, 'submit_button');
        change_user_tests($changeTestList);
        header("Location: ../mainPage");
        break;

    case 'list_user_tests':
        $testSelectedList = get_selected_test_list($user->usr_id);

        $sort_by = filter_input(INPUT_GET, 'sort');
        if ($sort_by == NULL) {
            $sort_by = 1;
        }
        $sort_order = filter_input(INPUT_GET, 'order');
        if ($sort_order == NULL) {
            $sort_order = 1;
        }

        $filter_full = filter_input(INPUT_POST, 'full_button');
        $filter_past = filter_input(INPUT_POST, 'past_button');
        if (!empty($filter_full)) {
            $_SESSION['filter_full'] = !$_SESSION['filter_full'];
        }
        if (!empty($filter_past)) {
            $_SESSION['filter_past'] = !$_SESSION['filter_past'];
        }
        $full_num = $_SESSION['filter_full'] ? 1 : 0;
        $past_num = $_SESSION['filter_past'] ? 1 : 0;

        $selList = [];
        foreach ($testSelectedList as $test) {
            array_push($selList, $test['test_id'] . ":" . $test['test_time_id']);
        }

        $testList = get_test_list($user->usr_id, $sort_by, $sort_order, $full_num, $past_num);

        include "view.php";
        break;


    default:
        echo('Unknown account action: ' . $action);
        break;

}

verify_logged_in();

$action = filter_input(INPUT_GET, 'action');
if (isset($action) and ($action == "logout")) {
    if (isset($_SESSION['prev_usr_id'])) {
        $_SESSION['user'] = User::getUserByUsrId($_SESSION['prev_usr_id']);
        $_SESSION['prev_usr_id'] = NULL;
        header("Location: ../admin/index.php");
    } else {
        session_destroy();
        header("Location: ../index.php");
    }
}

exit();