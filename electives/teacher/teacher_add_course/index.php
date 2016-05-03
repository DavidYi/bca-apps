<?php
/**
 * Created by PhpStorm.
 * User: macbook
 * Date: 12/14/15
 * Time: 1:04 PM
 */

/* These messages are used to customize the login page. */

//include (__DIR__ . "/../../model/teacher_db.php");
//include (__DIR__ . "/../../../shared/index.php");

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'default';
    }
}

switch ($action) {
    case 'default':
        include("/view.php");
    case 'add_course':
        require_once(__DIR__ . "/../../model/teacher_db.php");

        $allFieldsFilled = true;

        if (isset($_POST["submit"])) {
            if (empty($_POST["day"])) {
                $day = $_POST["day"];
            } else $allFieldsFilled = false;

            if (empty($_POST["mods"])) {
                $mods = $_POST["mods"];
                $startMod = intval(substr($mods, 0,1));
                $endMod = intval(substr($mods, 2, 1));
            } else $allFieldsFilled = false;

            if (empty($_POST["class_name"])) {
                $courseName = $_POST["class_name"];
            } else $allFieldsFilled = false;

            if (empty($_POST["description"])) {
                $description = $_POST["description"];
            } else $allFieldsFilled = false;

            if ($allFieldsFilled) {
                addCourse($courseName, $description);
                echo "<h1>New course created successfully</h1>";
            } else {
                echo "<h1>Not all fields were completed</h1>";
            }
        }
}
?>