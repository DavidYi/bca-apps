<?php

require_once('../util/main.php');
//require_once('../../util/tags.php');
require('../model/senior_db.php');
require('../model/presentations_db.php');

if(!isSeniortime()){
    header("Location: ../itinerary");
}

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
}

switch ($action) {
    case 'show_add_presentation':
        $fields = get_field_list();
        $sessions = get_session_room_pairs();
        include 'presentation_add.php';
        break;

    case 'add_presentation':
        $pres_title = filter_input(INPUT_POST, 'pres_title');
        $pres_desc = filter_input(INPUT_POST, 'pres_desc');
        $organization = filter_input(INPUT_POST, 'organization');
        $location = filter_input(INPUT_POST, 'location');
        $field_id = filter_input(INPUT_POST, 'field_id');
        $room_id = filter_input(INPUT_POST, 'rm_id');
        $ses_id = filter_input(INPUT_POST, 'ses_id');

        add_pres($pres_title, $pres_desc, $organization, $location, $user->usr_id, $field_id, $rm_id, $ses_id);

        $pres = SeniorPresentation::getPresentationForSenior ($user->usr_id);
        include "presentation_view.php";
        break;

    case 'show_modify_presentation':
        $pres = SeniorPresentation::getPresentationForSenior($user->usr_id);
        $fields = get_field_list();
        include 'presentation_modify.php';
        break;

    case 'modify_presentation':
        // Need to code
        $pres_title = filter_input(INPUT_POST, 'pres_title');
        $pres_desc = filter_input(INPUT_POST, 'pres_desc');
        $organization = filter_input(INPUT_POST, 'organization');
        $location = filter_input(INPUT_POST, 'location');
        $field_id = filter_input(INPUT_POST, 'field_id');

        $pres = SeniorPresentation::getPresentationForSenior ($user->usr_id);

        mod_pres($pres->pres_id, $pres_title, $pres_desc, $organization, $location, $field_id);

        $pres = SeniorPresentation::getPresentationForSenior ($user->usr_id);

        include "presentation_view.php";
        break;

    default:
        $pres = SeniorPresentation::getPresentationForSenior ($user->usr_id);
        include "presentation_view.php";
}



?>