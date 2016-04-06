<?php

require_once('../util/main.php');
//require_once('../../util/tags.php');
require('../model/senior_db.php');
require('../model/presentations_db.php');

/*if(!isSeniortime()){
    header("Location: ../itinerary");
}*/

$pres = Presentation::getPresentationForSenior ($user->usr_id);

if ($pres == NULL) {
    //go to add presentation
    $pres_title = '';
    $pres_desc = '';
    $organization = '';
    $location = '';
    $field_id = '';
    $room_id = '';
    $ses_id = '';

    add_pres($pres_title, $pres_desc, $organization, $location, $user->usr_id, $field_id, $rm_id, $ses_id);
}

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
}

switch ($action) {
    case 'show_presentation':
        include "show_presentation.php";

        break;

    case 'show_modify_presentation':
        $fields = get_field_list();
        include 'show_modify_presentation.php';

        break;

    default:
        include "show_presentation.php";

        break;
}
?>