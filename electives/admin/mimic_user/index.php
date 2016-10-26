<?php
/**
 * Created by PhpStorm.
 * User: macbook
 * Date: 3/2/16
 * Time: 9:30 AM
 */

require_once ("../../util/main.php");
require_once (__DIR__ . "/../../../shared/model/user_db.php");
require_once (__DIR__ . "/../../../shared/model/database.php");
verify_admin();
$action = strtolower(filter_input(INPUT_POST, 'action'));

if (empty($action))
    $action = 'show_users';

switch ($action) {
    case 'show_users':
        $user_list = get_user_list();

        include ('view.php');
        break;

    case 'login':
        $usr_id = filter_input(INPUT_POST, "usr_id");
        $_SESSION['prev_usr_id'] = $user->usr_id;

        $user = User::getUserByUsrId($usr_id);
        $_SESSION['user'] = $user;

        if ($user->usr_type_cde == 'TCH') {
            // The user is an teacher, so they are directed to teacher page
            header("Location: ../../teacher/index.php");

        } else {
            // The user is a student, they are directed to the student sign up page
            header("Location: ../../Student/index.php");
        }

        break;

    default:
        echo ("No action found.");
        break;
}