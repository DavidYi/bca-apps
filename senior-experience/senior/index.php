<?php

require_once('../util/main.php');
//require_once('../../util/tags.php');
require('../model/senior_db.php');

if($user->usr_grade_lvl != 12){
    echo($user->usr_grade_lvl);
    header("Location: ../itinerary");
}

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'list_presentations';
    }
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

        break;



    default :
        include 'list_pres.php';


}
?>