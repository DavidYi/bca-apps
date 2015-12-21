<?php
/**
 * Created by PhpStorm.
 * User: macbook
 * Date: 12/14/15
 * Time: 1:04 PM
 */
require_once("../model/database.php");
require_once("../model/presentations_db.php");
require_once("../errors/db_error.php");
require_once ("../errors/db_error_connect.php");

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
        $user_from_post = get_user(filter_input(INPUT_POST, 'usr_id'));
        session_start();

        $_SESSION['usr_id'] = $user_from_post['usr_id'];
        $_SESSION['usr_role_cde'] = $user_from_post['usr_role_cde'];
        $_SESSION['usr_type_cde'] = $user_from_post['usr_type_cde'];

        if ($user_from_post['usr_role_cde'] == 'ADM') {
            // The user is an admin, so they are directed to  admin page
            header("Location: ../admin/index.php");
        } else {
            // The user is a student or teacher, they are directed to sign up page
            header("Location: ../index.php");
        }

        break;
}

?>