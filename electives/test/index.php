<?php
/**
 * Created by PhpStorm.
 * User: macbook
 * Date: 12/14/15
 * Time: 1:04 PM
 */
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



        if ($user->getRole('OELE') == 'ADM') {
            header("Location: ../admin");
        } elseif ($user->usr_type_cde == 'TCH'){
            header("Location: ../teacher");
        } else {
            header("Location: ../student");
        }
}

?>


