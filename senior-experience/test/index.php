<?php
/**
 * Created by PhpStorm.
 * User: macbook
 * Date: 12/14/15
 * Time: 1:04 PM
 */
require_once("../model/database.php");
require_once("../../shared/model/database.php");
require_once("../../shared/model/user_db.php");


$action = strtolower(filter_input(INPUT_POST, 'action'));

if ($action == NULL) {
    $action = 'show_users';
}

switch ($action) {
    case 'show_users':
        $user_list = get_user_list();

        include('login.php');
        break;

    case 'login':
        /**
         * The following session variables are set:
         * usr_id
         * usr_role_cde
         * user_type_cde
         */
        session_start();
        $user_from_post = filter_input(INPUT_POST, 'usr_id');
        $user = User::getUserByUsrId($user_from_post);
        $_SESSION['user'] = $user;



        if ($user->getRole('CAR') == 'ADM') {
// The user is an admin, so they are directed to  admin page
            header("Location: ../admin/index.php");
        }
        else if(($user->usr_grade_lvl == 12) && isSeniorTime()){
            // The user is eligible to make presentation, they are directed to pres add page
            header("Location: ../senior/index.php");
        }
        else {
// The user is a student or teacher, they are directed to sign up page
            header("Location: ../itinerary/index.php");
        }
}
function isSeniortime()
{
    require_once('../model/senior_db.php');
    global $user;
    $signup_dates = get_senior_add_pres_dates();

    date_default_timezone_set('America/New_York');
    $currentTime = time();
    $startTime = strtotime($signup_dates['start']);
    $endTime = strtotime($signup_dates['end']);

    //$startTimeFormatted = date('M d, g:i  a', $startTime);
    //$endTimeFormatted = date('M d, g:i  a', $endTime);


    if (($currentTime > $startTime) and ($currentTime < $endTime))
        return true;
    else
        return false;
}
?>


