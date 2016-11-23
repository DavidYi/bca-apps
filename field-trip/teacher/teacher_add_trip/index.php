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
    case 'add_trip':

        $trip_name = $_POST['trip_name'];
        $destination = $_POST['destination'];
        $num_students = $_POST['num_students'];
        $start_date = $_POST['start_date'];
        $start_time = $_POST['start_time'];
        $end_date = $_POST['end_date'];
        $end_time = $_POST['end_time'];
        $purpose = $_POST['purpose']; 

        add_trip($trip_name, $destination, $num_students, $start_date, $start_time, $end_date, $end_time, $usr_id, $purpose);
        header("Location: ../index.php");

        break;
    case 'default':
        include("./view.php");

}
?>
