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
        # TODO: Write Login Code
        /**
         * Session Variables to set:
         * usr_id
         * usr_role
         * user_type
         */

        ?><script>console.log("works")</script><?php
}

?>