<?php

require_once('../util/main.php');
//require_once('../../util/tags.php');
require('../model/senior_db.php');
require('../model/presentations_db.php');

/* if(!isSeniortime()){
    header("Location: ../itinerary");
} */

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
}

switch ($action) {
    case 'show_add_presentation':
        $fields = get_field_list();
        $sessions = get_session_room_pairs();
        $teammates = get_potential_teammates();
        include 'presentation_add.php';
        break;

    case 'add_presentation':
        $pres_title = filter_input(INPUT_POST, 'pres_title');
        $pres_desc = filter_input(INPUT_POST, 'pres_desc');
        $organization = filter_input(INPUT_POST, 'organization');
        $location = filter_input(INPUT_POST, 'location');
        $field_id = filter_input(INPUT_POST, 'field_id');
        $rm_id = explode(":", filter_input(INPUT_POST, 'session_room_id'))[1];
        $ses_id = explode(":", filter_input(INPUT_POST, 'session_room_id'))[0];
        $team_members = filter_input(INPUT_POST, 'team-members'). ',';
        add_pres($pres_title, $pres_desc, $organization, $location, $user->usr_id, $field_id, $rm_id, $ses_id, $team_members);

        $pres = SeniorPresentation::getPresentationForSenior ($user->usr_id);
        include "presentation_view.php";
        break;

    case 'show_modify_presentation':
        $presentation = SeniorPresentation::getPresentationForSenior($user->usr_id);
        $presenter_ids = get_presenter_ids($presentation->pres_id);
        $fields = get_field_list();
        $sessions = get_session_room_pairs_plus_presentation($presentation->pres_id);
        $teammates = get_potential_teammates_plus_presentation($presentation->pres_id);
        include 'presentation_modify.php';
        break;

    case 'delete_presentation':
        $pres_id = filter_input(INPUT_GET, 'pres_id');
        $pres = SeniorPresentation::getPresentationForSenior ($user->usr_id);

        if ($pres->pres_id != $pres_id) {
            display_user_message("You do not have permission to delete this presentation.", "./index.php");
        }

        echo ("Delete the presentation here.");
        exit();
        break;



    case 'modify_presentation':
        // Need to code
        $choice = filter_input(INPUT_POST, 'choice');
        $pres_id = filter_input(INPUT_POST, 'pres_id');
        $pres_title = filter_input(INPUT_POST, 'pres_title');
        $pres_desc = filter_input(INPUT_POST, 'pres_desc');
        $organization = filter_input(INPUT_POST, 'organization');
        $location = filter_input(INPUT_POST, 'location');
        $field_id = filter_input(INPUT_POST, 'field_id');
        $rm_id = explode(":", filter_input(INPUT_POST, 'ses-room-number'))[1];
        $ses_id = explode(":", filter_input(INPUT_POST, 'ses-room-number'))[0];
        $team_members = filter_input(INPUT_POST, 'team-members'). ',';

        if ($choice == 'Modify') {
            // Append the current user to the team list.
            if (strlen($team_members) > 0) {
                $team_members = $team_members . ',' . $user->usr_id;
            }
            else {
                $team_members = $user->usr_id;
            }

            $pres = SeniorPresentation::getPresentationForSenior ($user->usr_id);

            if ($pres->pres_id != $pres_id) {
                display_user_message("You do not have permission to modify this presentation.");
            }

            mod_pres($pres->pres_id, $pres_title, $pres_desc, $organization, $location, $field_id, $team_members);

        }
        $pres = SeniorPresentation::getPresentationForSenior ($user->usr_id);

        include "presentation_view.php";
        break;

    default:
        $pres = SeniorPresentation::getPresentationForSenior ($user->usr_id);
        include "presentation_view.php";
}



?>