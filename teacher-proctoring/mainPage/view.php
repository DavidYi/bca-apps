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
    <link href="../ss/main.css<?php echo(getVersionString()); ?>" rel="stylesheet">
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
            <h3><b><?php echo($user->usr_first_name . " " . $user->usr_last_name); ?></b></h3>
            <h3 class="log-out"><a href="./index.php?action=logout">
                    <?php if (isset($_SESSION['prev_usr_id'])) { ?> Return to Admin Panel <?php } else { ?> Log Out <?php } ?>
                </a></h3>
        </div>
        <div class="vertical-center">
            <?php if (!isset($_SESSION['prev_usr_id'])) { ?>
                <h1>Register For Proctoring</h1>
                <h3> You have scheduled <?php echo implode($count) ?> of 12 hours. </h3>
                <h3> Technical problems? <BR> &nbsp Contact <a href="mailto:bryres@bergen.org"> Bryan Respass </a></h3>
                <h3> Other questions? <BR> &nbsp Contact <a href="mailto:viclyn@bergen.org"> Vic Lynch </a></h3>
            <?php } else { ?>
                <h1>Mimic User Mode</h1>
            <?php } ?>
        </div>
    </div>
    <div class="view-signup enrollment">
        <div class="vertical-center">

            <!--            <h7 style="left:18%;text-align:center">These are your current registration times:</h7>-->

            <nav class="navbar">
                <h1></h1>
                <div class="session-filter tag" style="width: 25%;">Date</div>
                <div class="session-filter company" style="width: 25%;">Mods</div>
                <div class="session-filter presenter" style="width: 25%;">Test Name</div>
                <div class="session-filter position" style="width: 25%;">Location</div>
            </nav>

            <div style="overflow-y:scroll; height:300px;">

                <?php foreach ($testSelectedList as $test) { ?>
                    <div class="session view-session" style="height: 15%; font-size: 75%; background-color: white;">
                        <?php if ($test != NULL) { ?>
                            <div class="time" style="width: 25%;"><?php echo $test['test_dt'] ?></div>
                            <div class="mods" style="width: 25%;"><?php echo $test['test_time_desc'] ?></div>
                            <div class="name" style="width: 25%;"><?php echo $test['test_name'] ?></div>
                            <div class="position"
                                 style="width: 25%; text-align: center;"><?php echo $test['rm_nbr'] ?></div>
                        <?php } ?>
                    </div>
                <?php } ?>

            </div>

            <h1></h1>
            <form action="." method="post">
                <input type="hidden" name="action" value="show_itinerary">
                <br>
                <button type="submit" value="Add/Delete">Add/Delete</button>
            </form>

        </div>


    </div>

</section>
<script type="text/javascript" src="../js/jquery.min.js<?php echo(getVersionString()); ?>"></script>
<script type="text/javascript" src="../js/jquery.easing.min.js<?php echo(getVersionString()); ?>"></script>
<script type="text/javascript" src="../js/jquery.plusanchor.min.js<?php echo(getVersionString()); ?>"></script>
<script type="text/javascript">
    $('body').plusAnchor({
        easing: 'easeInOutExpo',
        speed: 700
    });

    $(document).ready(function () {

        //If test date has passed, grey out test.

        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1; //January is 0!
        var yyyy = today.getFullYear();

        if (dd < 10) {
            dd = '0' + dd
        }

        if (mm < 10) {
            mm = '0' + mm
        }

        today = yyyy + '-' + mm + '-' + dd;

        $('.view-session').each(function () {

            if ($(this).find('.time').text() < today)
        {
                $(this).css("background-color", "lightgrey");
            $(this).css("opacity", ".8");

               console.log("lol");
        }

    });
    })
    ;


</script>
</body>
</html>