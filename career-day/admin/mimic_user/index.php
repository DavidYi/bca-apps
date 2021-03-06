<?php
/**
 * Created by PhpStorm.
 * User: macbook
 * Date: 3/2/16
 * Time: 9:30 AM
 */

require_once ("../../util/main.php");
require_once (__DIR__ . "/../../../shared/model/user_db.php");
require_once (__DIR__ . "/../../model/mentor_admin_db.php");
require_once (__DIR__ . "/../../../shared/model/database.php");

$action = strtolower(filter_input(INPUT_POST, 'action'));

if (empty($action))
    $action = 'show_users';

switch ($action) {
    case 'show_users':
        $user_list = get_user_mimic_list();

        include ('view.php');
        break;

    case 'login':
        $usr_id = filter_input(INPUT_POST, "usr_id");
        $choice = filter_input(INPUT_POST, "choice");

        if($choice == "submit"){
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            $user = $_SESSION['user'];
            $_SESSION['prev_usr_id'] = $user->usr_id;
            $_SESSION['user'] = User::getUserByUsrId($usr_id);

            $_SESSION['allow_signups'] = !empty(filter_input(INPUT_POST, 'bypass_time')) ? true : false;

            header("Location: ../../itinerary/index.php");
        }
        else{
            header("Location: ../");
        }



//        if ($user->getRole('CAR') == 'ADM') {
//            // The user is an admin, so they are directed to admin page
//            header("Location: ../");
//        } else {
//            // The user is a student or teacher, they are directed to sign up page
//            header("Location: ../../itinerary/index.php");
//        }


        break;
}