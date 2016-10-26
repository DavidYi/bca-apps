<?php
/**
 * Created by PhpStorm.
 * User: matth
 * Date: 6/8/2016
 * Time: 9:27 AM
 */
require_once(__DIR__ . "/../../util/main.php");
require_once(__DIR__ . "/../../model/teacher_db.php");

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'default';
    }
}

switch ($action) {
    case 'default':
        $course_name = $_GET["course_name"];
        $course_desc = $_GET["course_desc"];
        $course_id = $_GET["course_id"];
        $active = $_GET["active"];
        include("view.php");
        break;

    case 'edit_course':
        $new_course_name = $_POST["new_course_name"];
        $new_course_desc = $_POST["new_course_desc"];
        $course_id = $_POST["course_id"];
        if(isset($_POST['active']) && $_POST['active'] == 'Yes')
        {
            $active = 1;
        }
        else{
            $active = 0;
        }

        $course = get_course_by_course_id($course_id);

        // Make sure users don't try to access courses that are not theirs.
        if (($user->getRole($app_cde) != 'ADM') && ($course["teacher_id"] !== $user->usr_id)){
            log_error ("Permission exception in course edit.  User id:" . $user->usr_id . "; Course ID: " . $course_id);
            display_user_message("Permission denied.", '/' . $app_url_path . '/teacher');
        }

        edit_course($course_id, $new_course_name, $new_course_desc, $active);
        header('Location: ..');
        break;
}
