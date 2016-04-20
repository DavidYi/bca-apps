<?php
require_once('../util/main.php');
//require_once('../../util/tags.php');
require_once('../model/senior_db.php');
require_once('../model/presentations_db.php');
if(!isSeniortime()){
header("Location: ../itinerary");
}



$pres = Presentation::getPresentationForSenior($user->usr_id);

if(($pres == NULL)){
    header("location: index.php?action=show_add_pres");
} else {
     ?>

     <section>
         <h1>My Presentation</h1>
            <h4>Title: <?php echo($pres->pres_title);?></h4>
             <h4>Description: <?php echo($pres->pres_desc);?></h4>
         <h4>Field: <?php echo($pres->field_name);?></h4>
         <h4>Location: <?php echo($pres->location);?></h4>
     </section>

     <?php
 }

?>








