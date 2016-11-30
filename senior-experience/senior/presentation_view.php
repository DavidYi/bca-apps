<?php
require_once('../util/main.php');
//require_once('../../util/tags.php');
require_once('../model/senior_db.php');
require_once ('../model/presentations_db.php');

?>

<html lang="en">
<head>
    <title>Senior Experience Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <!-- <link rel="shortcut icon" href="images/logo.ico"> -->

    <!-- Styles -->
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link href="../ss/main.css<?php echo(getVersionString()); ?>" rel="stylesheet">
    <?php include_analytics(); ?>
    <style>
        .view .view-signup{
            background-color: #60CE94;
        }
        button {
            background-color: #0d3f25;
        }
    </style>
</head>
<body>
<section class="main view">
    <div class="view-main">
        <div class="login-status">
            <h3><b><?php echo ($user->usr_first_name . " " . $user->usr_last_name); ?></b></h3>
            <h3 class="log-out"><a href="./index.php?action=logout">Log Out</a></h3>
        </div>
        <div class="vertical-center">
            <h1> Senior Expositions will be on June 1!</h1>
            <h3> You have until May 15th to create your presentation.</h3>
            <h3> After that date, students will have the opportunity to sign-up to watch your presentation.</h3>
        </div>
    </div>
    <div class="view-signup enrollment">
        <div class="vertical-center">
            <?php if ($pres != null){ ?>
                <h1>My Presentation</h1>
                <h3>Title: <?php echo($pres->pres_title);?></h3>
                <h3>Description: <?php echo($pres->pres_desc);?></h3>
                <h3>Organization: <?php echo($pres->organization);?></h3>
                <h3>Org. Location: <?php echo($pres->location);?></h3>
                <h3>Field: <?php echo($pres->field_name);?></h3>
                <h3>Room: <?php echo($pres->rm_nbr);?></h3>
                <h3>Session: <?php echo($pres->ses_id);?></h3>
                <h3># Students (Enrolled/Max): <?php echo($pres->pres_enrolled_students);?> / <?php echo($pres->pres_max_students);?></h3>
                <h3>Presenters: <?php echo($pres->presenters);?> </h3>

                <div>
                    <form action="." method="post">
                        <input type="hidden" name="action" value="show_modify_presentation">
                        <br>
                        <button type="submit" value="Modify Presentation">Modify Presentation</button>
                    </form>
                </div>
            <?php } else { ?>
                <div style="text-align: center" class="vertical-center">
                    <h3>Let's get started!  Create your presentation.</h3>
                    <form action="." method="post">
                        <input type="hidden" name="action" value="show_add_presentation">
                        <br>
                        <button type="submit" value="Create Presentation">Create Presentation</button>
                    </form>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<script type="text/javascript" src="../js/jquery.min.js<?php echo(getVersionString()); ?>"></script>
<script type="text/javascript" src="../js/jquery.easing.min.js<?php echo(getVersionString()); ?>"></script>
<script type="text/javascript" src="../js/jquery.plusanchor.min.js<?php echo(getVersionString()); ?>"></script>
<script type="text/javascript">
    $('body').plusAnchor({
        easing: 'easeInOutExpo',
        speed:  700
    });
</script>
</body>
</html>