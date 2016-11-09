<?php
/**
 * Created by PhpStorm.
 * User: macbook
 * Date: 12/14/15
 * Time: 1:04 PM
 */

/* These messages are used to customize the login page. */
require_once(__DIR__ . "/../../util/main.php");
require_once(__DIR__ . "/../../model/teacher_db.php");
require_once(__DIR__ . "/../../model/times_db.php");
verify_teacher();
$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'default';
    }
}

$usr_id = $user->usr_id;

switch ($action) {
    case 'add_course':

        $course_name = $_POST['course_name'];
        $course_desc = $_POST['course_desc'];

        add_course($course_name, $course_desc, $usr_id);
        header("Location: ../index.php");

        break;
    case 'default':
        include("./view.php");

}
?>
