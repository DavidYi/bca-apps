<?php

require_once('../../util/main.php');
require_once('../../model/workshop_admin_db.php');

verify_admin();

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'list_rooms';
    }
}

switch ($action) {
    case 'list_rooms':

        // Get the teacher list
        $roomList = get_room_list();

        // View the list of workshops
        include 'room_list.php';
        break;

    case 'show_add_room':
        $error_msg = '';
        $room_id = '';
        $room_nbr = '';
        include 'room_add.php';
        break;

    case 'add_room':
        $choice = filter_input(INPUT_POST, 'choice');
        $room_nbr = filter_input(INPUT_POST, 'room_nbr');

        // The user either pressed Add or Cancel.
        // If Add, then add the room.
        // Otherwise, just skip down to the list redraw.

        if ($choice == 'Add') {
            add_room($room_nbr);
        }
        $roomList = get_room_list();
        include('room_list.php');
        break;

    case 'show_modify_room';
        $room_id = filter_input(INPUT_GET, 'room_id');

        $room = get_room($room_id);

        $room_nbr = $room['rm_nbr'];

        include 'room_modify.php';
        exit();
        break;

    case 'modify_room':
        $choice = filter_input(INPUT_POST, 'choice');
        $room_nbr = filter_input(INPUT_POST, 'room_nbr');
        $room_id = filter_input(INPUT_POST, 'room_id');
        
        if(filter_input(INPUT_POST, 'choice') == "Modify") {
            modify_room($room_id, $room_nbr);
        }


        $roomList = get_room_list();
        include('room_list.php');
        exit();
        break;


    case 'delete_room':
        $room_id = filter_input(INPUT_GET, 'room_id');
        delete_room($room_id);

        $roomList = get_room_list();
        include('room_list.php');
        exit();
        break;

    default:
        display_error('Unknown workshop action: ' . $action);
        break;
}
?>