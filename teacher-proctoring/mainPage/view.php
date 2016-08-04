<?php
require_once('../util/main.php');
//require_once('../../util/tags.php');
require_once('../model/teacher_db.php');
?>

<html lang="en">
<head>
    <title>Register for Proctoring</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <!-- <link rel="shortcut icon" href="images/logo.ico"> ->

    <!--Styles-->
    <link href="../ss/main.css" rel="stylesheet">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <?php include_analytics(); ?>
    <style>
        button {
            height: 4.5em;
            width: 20em;
            left: 35%;
        }
    </style>
</head>
<body>
<section class="main view">
    <div class="view-main">
        <div class="login-status">
            <h3><b><?php echo($user->usr_first_name . " " . $user->usr_last_name);?></b></h3>
            <h3 class="log-out"><a href="./index.php?action=logout">
                    <?php if (isset($_SESSION['prev_usr_id'])) { ?> Return to Admin Panel <?php } else { ?> Log Out <?php } ?>
                </a></h3>
        </div>
        <div class="vertical-center">
            <?php if (!isset($_SESSION['prev_usr_id'])) { ?>
                <h1>Register For Proctoring</h1>
                <h3> You will have completed <?php echo implode($count) ?> hours out of 12. </h3>
                <h3> Email <a href="mailto:viclyn@bergen.org"> Mr. Lynch </a> with any questions.</h3>
            <?php } else { ?>
                <h1>Mimic User Mode</h1>
            <?php } ?>
        </div>
    </div>
    <div class="view-signup enrollment">
        <div class="vertical-center">

        <h7 style="left:18%">These are your current registration times: </h7>

            <nav class="navbar">
                <h1></h1>
                <div class="session-filter tag">Date</div>
                <div class="session-filter company">Mods</div>
                <div class="session-filter presenter">Test Name</div>
            </nav>

            <div style="overflow-y:scroll; height:300px;">

                <?php foreach ($testSelectedList as $test) { ?>
                 <div class="session view-session">
                        <?php if ($test != NULL) { ?>
                            <div class="time"><?php echo $test['test_dt']?></div>
                            <div class="mods"><?php echo $test['test_time_desc']?></div>
                            <div class="name"><?php echo $test['test_name']?></div>
                        <?php } ?>
                    </div>
                <?php } ?>

            </div>

            <h1></h1>
            <form action="." method="post">
                <input type="hidden" name="action" value="show_itinerary">
                <br>
                <button type = "submit" value="Add/Delete">Add/Delete</button>
            </form>

        </div>


    </div>

</section>
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery.easing.min.js"></script>
<script type="text/javascript" src="../js/jquery.plusanchor.min.js"></script>
<script type="text/javascript">
    $('body').plusAnchor({
        easing: 'easeInOutExpo',
        speed:  700
    });
</script>
</body>
</html>
