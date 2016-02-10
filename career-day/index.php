<?php
/**
 * Created by PhpStorm.
 * User: macbook
 * Date: 12/14/15
 * Time: 1:04 PM
 */
require_once("./model/database.php");
require_once("../shared/model/user_db.php");

$action = strtolower(filter_input(INPUT_POST, 'action'));

if (($action == NULL) || ($action != 'login' )){
    $message = "";
    include('login.php');
    exit();
}
else {
    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');

    $pos = strpos($username, "@");
    if ($pos !== false) {
        $username = substr($username,0,$pos);
    }

    if (!bergenAuthLDAP($username, $password)) {
        $message = "Username, password combination is not correct.";
        include('login.php');
        exit();
    }
    $user = get_user_by_username($username, 'CAR');

    //
    // need to somehow check if the user was not found.

    session_start();

    $_SESSION['usr_id'] = $user['usr_id'];
    $_SESSION['usr_role_cde'] = $user['usr_role_cde'];
    $_SESSION['usr_type_cde'] = $user['usr_type_cde'];

    if ($user['usr_role_cde'] == 'ADM') {
        // The user is an admin, so they are directed to  admin page
        header("Location: ./admin/index.php");
    } else {
        // The user is a student or teacher, they are directed to sign up page
        header("Location: itinerary/index.php");
    }
}

?>