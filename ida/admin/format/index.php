<?php

require_once('../../util/main.php');
require_once('../../model/workshop_admin_db.php');

verify_admin();

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'list_formats';
    }
}

switch ($action) {
    case 'list_formats':

        // Get the teacher list
        $formatList = get_format_list();

        // View the list of workshops
        include 'format_list.php';
        break;

    case 'show_add_format':
        $error_msg = '';
        $format_id = '';
        $format_name = '';
        include 'format_add.php';
        break;

    case 'add_format':
        $choice = filter_input(INPUT_POST, 'choice');
        $format_name = filter_input(INPUT_POST, 'format_name');

        // The user either pressed Add or Cancel.
        // If Add, then add the room.
        // Otherwise, just skip down to the list redraw.

        if ($choice == 'Add') {
            add_format($format_name);
        }
        $formatList = get_format_list();
        include('format_list.php');
        break;

    case 'show_modify_format';
        $format_id = filter_input(INPUT_GET, 'format_id');

        $format = get_format($format_id);

        $format_name = $format['format_name'];

        include 'format_modify.php';
        exit();
        break;

    case 'modify_format':
        $choice = filter_input(INPUT_POST, 'choice');
        $format_name = filter_input(INPUT_POST, 'format_name');
        $format_id = filter_input(INPUT_POST, 'format_id');
        
        if(filter_input(INPUT_POST, 'choice') == "Modify") {
            modify_room($format_id, $format_name);
        }


        $formatList = get_format_list();
        include('format_list.php');
        exit();
        break;


    case 'delete_format':
        $format_id = filter_input(INPUT_GET, 'format_id');
        delete_format($format_id);

        $formatList = get_format_list();
        include('format_list.php');
        exit();
        break;

    default:
        display_error('Unknown workshop action: ' . $action);
        break;
}
?>