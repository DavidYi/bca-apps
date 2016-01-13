
<?php

include('../../util/main.php');
include('../../model/signup_status_db.php');

// add some kind of check here to make sure the user is logged in as an admin
// util/main checks for logged in, don't know how to check for admin permissions

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'display_status';
    }
}
$result = "";

switch($action) {
    case "auto_enroll":
        $grade = filter_input(INPUT_POST, 'grade');
        if ($grade == NULL) {
            $grade = filter_input(INPUT_GET, 'grade');
            if ($grade == NULL) {
                $grade = 'Invalid input.';
            }
        }
        random_enroll($grade);
        $enroll_list = get_registered_users();
        include 'view.php';
        break;
    case "undo_auto_enroll":
        $grade = filter_input(INPUT_POST, 'grade');
        if ($grade == NULL) {
            $grade = filter_input(INPUT_GET, 'grade');
            if ($grade == NULL) {
                $grade = 'Invalid input.';
            }
        }
        undo_enroll($grade);
        $enroll_list = get_registered_users();
        include 'view.php';
        break;
    case "display_status":
        $enroll_list = get_registered_users();
        include 'view.php';
        break;
    default:
        display_error("Invalid action: " . $action);
        break;
    }
?>
