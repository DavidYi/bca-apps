<?php
require_once('../../util/main.php');
require_once('../../model/database.php');
require_once('../../model/signups_db.php');

verify_admin();

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'list_signup_dates';
    }
}

switch ($action) {
    case 'list_signup_dates':

        $signup_datesList = get_signup_dates_list();

        include 'signup_dates_list.php';
        exit();
        break;

    case 'show_add_signup_dates':
        $error_msg = '';

        $class_year = '';
        $start = '';
        $end = '';

        $signup_dates_types = get_signup_dates_types();
        include 'signup_dates_add.php';
        exit();
        break;

    case 'add_signup_dates':
        $error_msg = '';

        $class_year = filter_input(INPUT_POST, 'class_year');
        $start = filter_input(INPUT_POST, 'start');
        $end = filter_input(INPUT_POST, 'end');

        if ($choice == 'Add') {
            if (empty($class_year)) {
                $error_msg .= "The class year is required.<BR>";
            }
            if (empty($start)) {
                $error_msg .= "The start date is required.<BR>";
            }
            if (empty($end)) {
                $error_msg .= "The end date is required.<BR>";
            }

            if ($error_msg != "") {
                $signup_dates_types = signup_dates_types();
                include 'signup_dates_add.php';
                exit();
            }
            else {
                add_signup_dates ($class_year, $start, $end);
            }
        }

        $signup_datesList = get_signup_dates_list();
        include('signup_dates_list.php');
        exit();
        break;

    case 'show_modify_signup_dates':
        $error_msg = '';
        $class_year = $signup_dates['class_year'];
        $start = $signup_dates['start'];
        $end = $signup_dates['end'];

        include 'signup_dates_modify.php';
        exit();
        break;

    case 'modify_signup_dates':
        $error_msg = '';

        $class_year = filter_input(INPUT_POST, 'class_year');
        $start = filter_input(INPUT_POST, 'start');
        $end = filter_input(INPUT_POST, 'end');

        if ($choice == 'Modify') {
            if (empty($class_year)) {
                $error_msg .= "The class year is required.<BR>";
            }
            if (empty($start)) {
                $error_msg .= "The start date is required.<BR>";
            }
            if (empty($end)) {
                $error_msg .= "The end date is required.<BR>";
            }

            if ($error_msg != "") {
                $signup_dates_types = get_signup_dates_types();
                include 'signup_dates_modify.php';
                exit();
            }
            else {
                modify_signup_dates ($class_year, $start, $end);
            }
        }

        $signup_datesList = signup_dates_list();
        include('signup_dates_list.php');
        exit();
        break;


    case 'delete_signup_dates':
        $class_year = filter_input(INPUT_GET, 'class_year');
        delete_signup_dates($class_year);

        $signup_datesList = get_signup_dates_list();
        include('signup_dates_list.php');
        exit();
        break;

    default:
        display_error('Unknown account action: ' . $action);
        exit();
        break;
}
?>