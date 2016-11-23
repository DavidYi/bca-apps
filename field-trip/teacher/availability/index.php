<?php
/**
 * Created by PhpStorm.
 * User: matth
 * Date: 7/13/2016
 * Time: 11:51 AM
 */
require_once(__DIR__ . "/../../util/main.php");
require_once(__DIR__ . "/../../model/teacher_db.php");
require_once(__DIR__ . "/../../model/times_db.php");

verify_logged_in();
$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'default';
    }
}

$available_times = get_times($user->usr_id);

// If the user is being mimicked by an admin, use that id as the updt id.
// Otherwise, use the id of the current user.
$updateById = $user->usr_id;

if (isset($_SESSION['prev_usr_id'])) {
    $updateById = $_SESSION['prev_usr_id'];
}

switch ($action) {
    case "update_times":
        $free_mods = $_POST["id_field"];
        $next_page = $_POST["next_page"];
        $decode = json_decode($free_mods, true);
        reset_times($user->usr_id);
        for ($i = 0; $i < $decode["length"]; $i++) {
            update_times($user->usr_id, $decode[$i], $updateById);
        }

        if ($next_page == 'admin') {
            $_SESSION['user'] = User::getUserByUsrId($_SESSION['prev_usr_id']);
            $_SESSION['prev_usr_id'] = NULL;
            header("Location: ../../admin/availability/index.php");
        }
        else if ($user->usr_type_cde == 'TCH') {
            header("Location: ../index.php");
        } else {
            header("Location: ../../Student/index.php");
        }
        break;
    case "back":
        $next_page = $_POST["next_page"];

        if ($next_page == 'admin') {
            $_SESSION['user'] = User::getUserByUsrId($_SESSION['prev_usr_id']);
            $_SESSION['prev_usr_id'] = NULL;
            header("Location: ../../admin/availability/index.php");
        }
        else if ($user->usr_type_cde == 'TCH') {
            header("Location: ../index.php");
        } else {
            header("Location: ../../Student/index.php");
        }
        break;
    default:
        $next_page = filter_input(INPUT_GET, 'next_page');
        if ($next_page == NULL) {
            $next_page = 'default';
        }

        include "view.php";
        break;
}