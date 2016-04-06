<?php

require_once('../util/main.php');
//require_once('../../util/tags.php');
require('../model/senior_db.php');
require('../model/presentations_db.php');

/*if(!isSeniortime()){
    header("Location: ../itinerary");
}*/

$pres = SeniorPresentation::getPresentationForSenior ($user->usr_id);

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
}

if($pres == NULL){
    include "show_add_pres.php";
    exit();
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