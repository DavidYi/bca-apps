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

$action = strtolower(filter_input(INPUT_POST, 'action'));

if (empty($action))
    $action = 'show_users';

switch ($action) {
    case 'show_users':
        $user_list = get_user_list();

        include ('view.php');
        break;

    case 'login':
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $usr_id = filter_input(INPUT_POST, "usr_id");
        $user = $_SESSION['user'];
        $_SESSION['prev_usr_id'] = $user->usr_id;
        $_SESSION['user'] = User::getUserByUsrId($usr_id);

//        if ($user->getRole('CAR') == 'ADM') {
//            // The user is an admin, so they are directed to  admin page
//            header("Location: ../");
//        } else {
//            // The user is a student or teacher, they are directed to sign up page
//            header("Location: ../../itinerary/index.php");
//        }

        header("Location: ../../itinerary/index.php");

        break;
}