<?php

require_once('../../util/main.php');
require_once('../../model/workshop_admin_db.php');

verify_admin();

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'list_presentations';
    }
}

switch ($action) {
    case 'list_presentations':

        // Get the teacher list
        $presentationList = get_presentation_list();

        // View the list of workshops
        include 'presentation_list.php';
        break;

    case 'show_add_presentation':
        $error_msg = '';
        $presId = '';
        $presenter_names = '';
        $org_name = '';
        $wkshp_id = '';
        $rm_id = '';
        $pres_max_seats = '';
        $ses_id = '';
        $wkshp_id = '';

        include 'presentation_add.php';
        break;

    case 'add_presentation':
        $choice = filter_input(INPUT_POST, 'choice');
        $presenter_names = filter_input(INPUT_POST, 'presenter_names');
        $org_name = filter_input(INPUT_POST, 'org_name');
        $rm_id = filter_input(INPUT_POST, 'rm_id');
        $pres_max_seats = filter_input(INPUT_POST, 'pres_max_seats');
        $wkshp_id = filter_input(INPUT_POST, 'wkshp_id');

        // The user either pressed Add or Cancel.
        // If Add, then add the presentation.
        // Otherwise, just skip down to the list redraw.

        if ($choice == 'Add') {
            add_presentation($presenter_names, $org_name, $rm_id, $pres_max_seats, $pres_enrolled_seats, $wkshp_id, $ses_id);
        }
        $presentationList = get_presentation_list();
        include('presentation_list.php');
        break;

    case 'show_modify_workshop':

        $workshop_id = filter_input(INPUT_GET, 'workshop_id');

        $workshop = get_workshop($workshop_id);


        $wkshp_nme = $workshop['wkshp_nme'];
        $wkshp_desc = $workshop['wkshp_desc'];
        $format_id = $workshop['format_id'];

        include 'presentation_modify.php';
        exit();
        break;

    case 'show_modify_presentation':

        $pres_id = filter_input(INPUT_GET, 'pres_id');

        $presentation = get_presentation($pres_id);

        $presenter_names = $presentation['pres_id'];
        $org_name = $presentation['org_name'];
        $wkshp_id = $presentation['wkshp_id'];
        $rm_id = $presentation['rm_id'];
        $pres_max_seats = $presentation['pres_max_seats'];
        $ses_id = $presentation['ses_id'];
        $wkshp_id = $presentation['wkshp_id'];

        include 'presentation_modify.php';
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
        include('presentation_list.php');
        exit();
        break;


    case 'delete_workshop':
        $workshop_id = filter_input(INPUT_GET, 'workshop_id');
        delete_workshop($workshop_id);

        $workshopList = get_workshop_list();
        include('presentation_list.php');
        exit();
        break;

    default:
        display_error('Unknown workshop action: ' . $action);
        break;
}
?>