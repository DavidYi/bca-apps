<?php

require_once('../util/main.php');
//require_once('../../util/tags.php');
require('../model/senior_db.php');
require('../model/presentations_db.php');

/*if(!isSeniortime()){
    header("Location: ../itinerary");
}*/
     header("Location: show_modify_presentation.php");
?>