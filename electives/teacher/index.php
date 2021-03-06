<?php
/**
 * Created by PhpStorm.
 * User: macbook
 * Date: 1/5/16
 * Time: 2:04 PM
 */

require_once(__DIR__ . "/../util/main.php");
require_once(__DIR__ . "/../../shared/model/user_db.php");
require_once(__DIR__ . "/../model/teacher_db.php");
require_once(__DIR__ . "/../model/times_db.php");

verify_teacher();

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'list_options';
    }
}

$usr_id = $user->usr_id;
$time_strings = get_time_strings($usr_id);

switch($action){
    case "logout":
        if (isset($action) and ($action == "logout")) {
            if (isset($_SESSION['prev_usr_id'])) {
                $_SESSION['user'] = User::getUserByUsrId($_SESSION['prev_usr_id']);
                $_SESSION['prev_usr_id'] = NULL;
                header("Location: ../admin/index.php");
            } else {
                session_destroy();
                header("Location: ../index.php");
            }
        }
        break;
    case "delete_course":
        
        delete_course($_GET['course_id']);
        $courses = get_course_by_user($user->usr_id);
        include("./view.php");
        break;

    default:
        $courses = get_course_by_user($user->usr_id);
        $usr_id = $user->usr_id;
        $available_times = get_times($usr_id);
        include("./view.php");
        break;
}


