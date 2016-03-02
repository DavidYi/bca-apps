<?php
/**
 * Created by PhpStorm.
 * User: macbook
 * Date: 2/17/16
 * Time: 10:36 AM
 */

require_once ("../../util/main.php");
require_once ("model/admin_db.php");

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
}

$error_msg = "";
if ($action == "add"){
    include("add_room.php");
    exit();
}

else if ($action == "add_room") {
    $choice = filter_input(INPUT_POST, "choice");
    $rm_nbr = filter_input(INPUT_POST, "rm_nbr");
    $rm_cap = filter_input(INPUT_POST, "rm_cap");

    if ($choice == "Add") {
        $error_msg = "";

        if (empty($rm_nbr)) {
            $error_msg .= "A room number is required. <BR>";
        } if (empty($rm_cap)) {
            $error_msg .= "A capacity for the room is required. <BR>";
        }

        if ($error_msg != "") {
            include ("add_room.php");
            exit();
        } else {
            add_room($rm_nbr, $rm_cap);
        }
    }
}

else if ($action == "delete") {
    $id = filter_input(INPUT_GET, "id");
    delete_room($id);
}

else if ($action == "edit") {
    $rm = get_room(filter_input(INPUT_GET, "id"));
    include ("edit_room.php");
    exit();
}

else if ($action == "edit_room") {
    $choice = filter_input(INPUT_POST, "choice");
    $rm_nbr = filter_input(INPUT_POST, "rm_nbr");
    $rm_cap = filter_input(INPUT_POST, "rm_cap");
    $rm_id = filter_input(INPUT_POST, "rm_id");

    if ($choice == "Make Changes") {
        $error_msg = "";

        if (empty($rm_nbr)) {
            $error_msg .= "A room number is required. <BR>";
        } if (empty($rm_cap)) {
            $error_msg .= "A capacity for the room is required <BR>";
        }

        if ($error_msg != "") {
            include ("edit_room.php");
            exit();
        } else {
            modify_room($rm_id, $rm_nbr, $rm_cap);
        }
    }
}

$rm_list = get_room_list();
include("view.php");
exit();

