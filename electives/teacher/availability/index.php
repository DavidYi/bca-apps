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


$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'default';
    }
}

$usr_id = get_usr_id($user->usr_first_name, $user->usr_last_name);
$available_times = get_times($usr_id);

// true: teacher, false:student
$teacher_or_student = $_GET['teacher'];

switch ($action) {
    case "update_times":
        $free_mods = $_POST["id_field"];
        $decode = json_decode($free_mods, true);
        reset_times($usr_id);
        for ($i = 0; $i < $decode["length"]; $i++){
            update_times($usr_id, $decode[$i]);
        }

        if ($teacher_or_student) {
            header("Location: ../index.php");
        } else {
            header("Location: ../../Student/index.php");
        }
        break;
    default:
        include "view.php";
        break;
}