<?php

require_once('../../util/main.php');
require_once('../../model/workshop_admin_db.php');

verify_admin();

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'list_workshops';
    }
}

switch ($action) {
    case 'list_workshops':

        // Get the teacher list
        $workshopList = get_workshop_list();

        // View the list of workshops
        include 'workshop_list.php';
        break;

    case 'show_add_workshop':
        $error_msg = '';
        $wkshpId = '';
        $wkshp_nme = '';
        $wkshp_desc = '';
        $format_id = '';

        include 'workshop_add.php';
        break;

    case 'add_workshop':
        $choice = filter_input(INPUT_POST, 'choice');
        $wkshp_nme = filter_input(INPUT_POST, 'wkshp_name');
        $wkshp_desc = filter_input(INPUT_POST, 'wkshp_desc');
        $format_id = filter_input(INPUT_POST, 'format_id');

        // The user either pressed Add or Cancel.
        // If Add, then add the workshop.
        // Otherwise, just skip down to the list redraw.

        if ($choice == 'Add') {
            add_workshop($wkshp_nme, $wkshp_desc, $format_id);
        }
        $workshopList = get_workshop_list();
        include('workshop_list.php');
        break;

    case 'show_modify_workshop';
        $workshop_id = filter_input(INPUT_GET, 'workshop_id');

        $workshop = get_workshop($workshop_id);

        $formatList = get_format_list();
        $wkshp_nme = $workshop['wkshp_nme'];
        $wkshp_desc = $workshop['wkshp_desc'];
        $format_id = $workshop['format_id'];

        include 'workshop_modify.php';
        exit();
        break;




    case 'modify_workshop':
        $choice = filter_input(INPUT_POST, 'choice');
        $workshop_name = filter_input(INPUT_POST, 'wkshp_name');
        $workshop_desc = filter_input(INPUT_POST, 'wkshp_desc');
        $format_id = filter_input(INPUT_POST, 'format_id');
        $workshop_id = filter_input(INPUT_POST, 'workshop_id');

        if(filter_input(INPUT_POST, 'choice') == "Modify") {
            modify_workshop($workshop_name, $workshop_desc, $format_id, $workshop_id);
        }


        $workshopList = get_workshop_list();
        include('workshop_list.php');
        exit();
        break;


    case 'delete_workshop':
        $workshop_id = filter_input(INPUT_GET, 'workshop_id');
        delete_workshop($workshop_id);

        $workshopList = get_workshop_list();
        include('workshop_list.php');
        exit();
        break;

    default:
        display_error('Unknown workshop action: ' . $action);
        break;
}
?>