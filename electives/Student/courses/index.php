<?php
/**
 * Created by PhpStorm.
 * User: macbook
 * Date: 1/5/16
 * Time: 2:04 PM
 */

require_once("../../util/main.php");
require_once("../../model/teacher_db.php");

verify_logged_in();

$action = filter_input(INPUT_GET, 'action');
if (isset($action) and ($action == "logout")) {
    session_destroy();
    header("Location: ../index.php");
}

$courseList = get_course_list_for_student($user->usr_id);

include ("./view.php");
exit();