<?php
/**
 * Created by PhpStorm.
 * User: Liam
 * Date: 2/3/16
 * Time: 10:36 AM
 */

require_once("../util/main.php");
require_once("model/admin_db.php");


$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
}

$error_msg = "";

if ($action == NULL) {
    include("view.php");
    exit();
} else if ($action == "show_add_room") {
    $rm_nbr = "";
    $rm_cap = "";
    include ("add_field.php");
    exit();
} else if ($action == "add_room") {
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
            include ("add_field.php");
            exit();
        } else {
            add_room($rm_nbr, $rm_cap);
        }
    }

    include ("view.php");
    exit();
} else if ($action == "show_add_field") {
    $field_name = "";
    include ("add_field.php");
    exit();
} else if ($action == "add_field") {
    $choice = filter_input(INPUT_POST, "choice");
    $field_name = filter_input(INPUT_POST, "field_name");

    if ($choice == "Add") {
        $error_msg = "";

        if (empty($field_name)) {
            $error_msg .= "New fields require a name. <BR>";
        }

        if ($error_msg != "") {
            include("add_field.php");
            exit();
        } else {
            add_field($field_name);
        }
    }

    include ("view.php");
    exit();
}