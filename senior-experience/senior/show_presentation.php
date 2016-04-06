<?php
require_once('../util/main.php');
//require_once('../../util/tags.php');
require_once('../model/senior_db.php');
require_once ('../model/presentations_db.php');
?>
     <section>
         <h1>My Presentation</h1>
            <h4>Title: <?php echo($pres->pres_title);?></h4>
             <h4>Description: <?php echo($pres->pres_desc);?></h4>
         <h4>Field: <?php echo($pres->field_name);?></h4>
         <h4>Location: <?php echo($pres->location);?></h4>
         <a href="index.php?action=show_modify_presentation">Edit</a>
     </section>









