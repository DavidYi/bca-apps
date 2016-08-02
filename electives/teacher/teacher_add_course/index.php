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

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'default';
    }
}

$usr_id = get_usr_id($user->usr_first_name, $user->usr_last_name);

switch ($action) {
    case 'add_course':
        $choice = filter_input(INPUT_POST, 'choice');
        if ($choice == "Add Course") {
            $allFieldsFilled = true;

            if (isset($_POST["choice"])) {
                if (!empty($_POST["class_name"])) {
                    $courseName = $_POST["class_name"];
                } else $allFieldsFilled = false;

                if (!empty($_POST["description"])) {
                    $description = $_POST["description"];
                } else $allFieldsFilled = false;

                if ($allFieldsFilled) {
                    add_course($courseName, $description, $usr_id);
                    echo "<script type='text/javascript'>
                            window.location.href='..';
                            </script>";
                    include('view.php?action=add_course');
                } else {
                    echo "<script type='text/javascript'>alert('Not all fields were completed');</script>";
                    include('view.php');
                }
            }
        } else {
            header('Location: ..');
        }
        break;
    case 'default':
        include("./view.php");

}
?>
