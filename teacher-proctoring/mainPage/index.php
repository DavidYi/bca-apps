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

switch ($action) {
    case 'delete_course':
        $test_id = filter_input(INPUT_GET, 'test_id');
        delete_course($test_id);

        $testList = get_test_list();

        include "view.php";

        break;


    case 'list_selected_tests':
        $testSelectedList = get_selected_test_list($user->usr_id);

        break;

    case 'show_itinerary':
        header("Location: ../itinerary");
        break;


    default:
        $testSelectedList = get_selected_test_list($user->usr_id);
        $count = get_count($user->usr_id);

        include "./view.php";
        break;
}

verify_logged_in();

$count = get_count($user->usr_id);

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
$testSelectedList = get_selected_test_list($user->usr_id);
include ("./view.php");
exit();