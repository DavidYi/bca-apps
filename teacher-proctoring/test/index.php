<?php

require_once("../util/main.php");
require_once("../../shared/model/user_db.php");

$action = strtolower(filter_input(INPUT_POST, 'action'));

if ($action == NULL) {
    $action = 'show_users';
}

switch ($action) {
    case 'show_users':
        $user_list = get_user_list_test_page();

        include('login.php');
        break;

    case 'login':
        /**
         * The following session variables are set:
         * usr_id
         * usr_role_cde
         * user_type_cde
         */
        $user_from_post = filter_input(INPUT_POST, 'usr_id');
        $user = User::getUserByUsrId($user_from_post);
        $_SESSION['user'] = $user;

        if ($user->getRole('TPOR') != NULL) {
            // The user is an admin, so they are directed to  admin page
            header("Location: ../admin/index.php");
        }
        else {
            // The user is a student or teacher, they are directed to sign up page
            header("Location: ../mainPage/index.php");
        }
}

?>