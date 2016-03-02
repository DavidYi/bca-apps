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
    include("add_field.php");
    exit();
}

else if ($action == "add_field") {
    $choice = filter_input(INPUT_POST, "choice");
    $field_name = filter_input(INPUT_POST, "field_name");

    if ($choice == "Add") {
        $error_msg = "";

        if (empty($field_name)) {
            $error_msg .= "The field needs a name. <BR>";
        }

        if ($error_msg != "") {
            include ("add_field.php");
            exit();
        } else {
            add_field($field_name);
        }
    }
}

else if ($action == "delete") {
    $id = filter_input(INPUT_GET, "id");
    delete_field($id);
}

else if ($action == "edit") {
    $field = get_field(filter_input(INPUT_GET, "id"));
    include ("edit_field.php");
    exit();
}

else if ($action == "edit_field") {
    $choice = filter_input(INPUT_POST, "choice");
    $field_name = filter_input(INPUT_POST, "field_name");
    $field_id = filter_input(INPUT_POST, "field_id");

    if ($choice == "Make Changes") {
        $error_msg = "";

        if (empty($field_name)) {
            $error_msg .= "A field name is required. <BR>";
        }

        if ($error_msg != "") {
            include ("edit_field.php");
            exit();
        } else {
            modify_field($field_id, $field_name);
        }
    }
}

$field_list = get_field_list();
include("view.php");
exit();

