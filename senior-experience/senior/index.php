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
    case 'show_add_pres':
        $fields = get_field_list();
        include 'presentation_add.php';

        break;
    case 'add_pres_into_db':
        $pres_title = filter_input(INPUT_POST, 'pres_title');
        $pres_desc = filter_input(INPUT_POST, 'pres_desc');
        $organization = filter_input(INPUT_POST, 'organization');
        $location = filter_input(INPUT_POST, 'location');
        $field_id = filter_input(INPUT_POST, 'field_id');
        $room_id = filter_input(INPUT_POST, 'rm_id');
        $ses_id = filter_input(INPUT_POST, 'ses_id');

        add_pres($pres_title, $pres_desc, $organization, $location, $user->usr_id, $field_id, $rm_id, $ses_id);

        include 'show_pres.php';

        break;


    default:
        $pres = Presentation::getPresentationForSenior ($user->usr_id);

        if ($pres == NULL) {
            //go to add presentation
            $fields = get_field_list();
            include "presentation_add.php";
        }

        else {
            // go to modify presentation
            header("Location: show_pres.php");
        }

}
?>