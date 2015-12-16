<?php
/**
 * Created by PhpStorm.
 * User: macbook
 * Date: 12/14/15
 * Time: 1:04 PM
 */

require_once("../model/presentations_db.php");
require_once("../model/database.php");

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
         * Session Variables to set:
         * usr_id
         * usr_role
         * user_type
         */
        $user = get_user($_POST['usr_id']);
        $_SESSION['usr_id'] = $user['usr_id'];
        $_SESSION['usr_role_cde'] = $user['usr_role_cde'];
        $_SESSION['usr_type_cde'] = $user['usr_type_cde'];
        http_redirect("../index.html", null, true, HTTP_REDIRECT_POST);
        exit();
}

?>