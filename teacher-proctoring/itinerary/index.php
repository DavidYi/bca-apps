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
        $action = 'list_tests';
    }
}

switch ($action) {

    case 'change_user_tests':
        $changeTestList = filter_input(INPUT_POST, 'submit_button');
        change_user_tests($changeTestList);
        header("Location: ../mainPage");
        break;

    case 'list_tests':
        $testSelectedList = get_selected_test_list($user->usr_id);
        $selList = [];
        foreach ($testSelectedList as $test) {
            array_push($selList, $test['test_id'] . ":" . $test['test_time_id']);
        }
        $testList = get_test_list();
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