<?php
/**
 * Created by PhpStorm.
 * User: shawnrobin
 * Date: 7/27/16
 * Time: 11:12 AM
 */

include('../../util/main.php');
require_once('../../model/admin_db.php');

verify_admin();
$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'default';
    }
}

switch ($action) {
    case 'modify':
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $usr_id = filter_input(INPUT_GET, "usr_id");

        $user = $_SESSION['user'];
        $_SESSION['prev_usr_id'] = $user->usr_id;

        $user = User::getUserByUsrId($usr_id);
        $_SESSION['user'] = $user;

        header("Location: ../../teacher/availability/index.php?next_page=admin");
        break;

    default:
        $free_mods = get_free_mods();
        include('./view.php');
        break;
}

?>