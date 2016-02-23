<?php
/**
 * Created by PhpStorm.
 * User: macbook
 * Date: 12/14/15
 * Time: 1:04 PM
 */
require_once("./model/database.php");
require_once("../shared/model/database.php");
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
    $user = User::getUserByBCAId($username);

    session_start();
    $_SESSION['user'] = $user;

    if ($user['usr_role_cde'] == 'ADM') {
        header("Location: admin");
    } else {
        header("Location: itinerary");
    }
}

?>