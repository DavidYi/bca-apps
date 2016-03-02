<?php

require_once('../util/main.php');
//require_once('../../util/tags.php');
require('../model/senior_db.php');
require('../model/presentations_db.php');

//if(!isSeniortime()){
//    header("Location: ../itinerary");
//}

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
}

$pres = Presentation::getPresentationForSenior ($user->usr_id);

if ($pres == NULL) {
    // Go to add presentation
}
else {
    // go to modify presentation
}

switch ($action) {
    case 'show_add_pres':
        include 'presentation_add.php';

        break;
    case 'add_pres_into_db':
        $pres_title = filter_input(INPUT_POST, 'title');
        $pres_desc = filter_input(INPUT_POST, 'desc');
        $pres_organization = filter_input(INPUT_POST, 'organization');
        $pres_location = filter_input(INPUT_POST, 'location');
        $pres_names = filter_input(INPUT_POST, 'names');

        add_pres($pres_title, $pres_desc, $pres_organization, $pres_location, $pres_names);


        include 'show_pres.php';

        break;


    default:
        include 'show_pres.php';


}
?>