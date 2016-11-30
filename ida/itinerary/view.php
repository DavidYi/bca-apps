<html lang="en">
<head>
    <title>IDA Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <!-- <link rel="shortcut icon" href="images/logo.ico"> -->

    <!-- Styles -->
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link href="../../shared/ss/main.css<?php echo(getVersionString()); ?>" rel="stylesheet">
    <link href="styles.css<?php echo(getVersionString()); ?>" rel="stylesheet">
</head>
<body>
<section class="main view">
    <div class="view-main">
        <div class="login-status">
            <h2><b><?php echo($user->usr_first_name . " " . $user->usr_last_name); ?></b></h2>
            <h2 class="log-out"><a href="./index.php?action=logout">
                    <?php if (isset($_SESSION['prev_usr_id'])) { ?> Return to Admin Panel <?php } else { ?> Log Out <?php } ?>
                </a></h2>
        </div>
        <div class="vertical-center">
            <?php if (!isset($_SESSION['prev_usr_id'])) { ?>
                <h1>IDA (Jan. 26)</h1>

                <?php if(!$isTeacher) { ?>

                    <?php if ($startTime > $currentTime) { ?>
                        <h2> Registration <b>has not opened</b>!</h2>
                        <h2> Opens: <?php echo $startTimeFormatted ?> </h2>

                    <?php } elseif ($endTime < $currentTime) { ?>
                        <h2> Registration has <b>ended</b>. </h2>
                        <h2> If you did not finish registering, a session will be assigned to you. </h2>

                    <?php } elseif ($registration_complete) { ?>
                        <h2> Registration <b>complete</b>! </h2>
                        <h2> You are all set for IDA. </h2>

                    <?php } else { ?>
                        <h2> Registration is <b>open</b>! </h2>
                        <h2> Closes: <?php echo $endTimeFormatted ?> </h2>
                    <?php } ?>

                <?php } ?>

                <h2> Click <b><a href="../../IDAWorkshopList.pdf" download>here</a></b> to preview the workshops.</h2>
                <h2> Email <b><a href="mailto:katbla@bergen.org"> Mrs. Blake </a></b> with any questions.</h2>



            <?php } else { ?>
                <h1>Mimic User Mode</h1>
            <?php } ?>
        </div>
    </div>
    <div class="view-signup enrollment">
        <div class="vertical-center">
            <?php foreach ($sessions as $session) { ?>

                <?php if (!$isTeacher && ($registrationOpen || isset($_SESSION['prev_usr_id']))) { ?>
                    <a href="../register/index.php?session=<?php echo $session['ses_times'] ?>&action=register">
                <?php } ?>

                <div class="session view-session <?php if(!$isTeacher) { ?>view-session-student<?php } else { ?>view-session-teacher<?php } ?>" onclick="">
                    <div class="session-number"><?php echo $session['ses_times'] ?></div>
                    <div class="time"><?php echo $session['ses_start_time'] ?></div>
                    <?php if ($session['ses_id'] != NULL) { ?>
                        <div class="session-title"><?php echo $session['wkshp_nme'] ?></div>
                        <div class="room-number">RM <?php echo $session['rm_nbr'] ?></div>
                    <?php } ?>
                </div>

                <?php if (!$isTeacher && ($registrationOpen || isset($_SESSION['prev_usr_id']))) { ?>
                    </a>
                <?php } ?>


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
        speed: 700
    });
</script>
</body>
</html>