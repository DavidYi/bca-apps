<<<<<<< HEAD
<html lang="en">
<head>
    <title>Career Day Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <!-- <link rel="shortcut icon" href="images/logo.ico"> -->

    <!-- Styles -->
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link href="../ss/main.css" rel="stylesheet">
    <?php include_analytics(); ?>
</head>
<body>
<section class="main view">
    <div class="view-main">
        <div class="login-status">
            <h3><b><?php echo($user->usr_first_name . " " . $user->usr_last_name); ?></b></h3>
            <h3 class="log-out"><a href="../index.php?action=logout">
                    <?php if (isset($_SESSION['prev_usr_id'])) { ?> Return to Admin Panel <?php } else { ?> Log Out <?php } ?>
                </a></h3>
        </div>
        <div class="vertical-center">
            <?php if (!isset($_SESSION['prev_usr_id'])) { ?>
                <h1>Career Day (Feb. 2)</h1>

                <?php if ($startTime > $currentTime) { ?>
                    <h3> Registration <b>has not opened</b>!</h3>
                    <h3> Opens: <?php echo $startTimeFormatted ?> </h3>

                <?php } elseif ($endTime < $currentTime) { ?>
                    <h3> Registration has <b>ended</b>. </h3>
                    <h3> If you did not finish registering, a session will be assigned to you. </h3>

                <?php } elseif ($registration_complete) { ?>
                    <h3> Registration <b>complete</b>! </h3>
                    <h3> Feedback <a
                            href="https://docs.google.com/forms/d/1WIjMjkT5w48ZM-T7vB1A2fo0Ipv-aAVnX0NDsstdF_c/viewform">survey</a>
                        about this site. </h3>

                <?php } else { ?>
                    <h3> Registration is <b>open</b>! </h3>
                    <h3> Closes: <?php echo $endTimeFormatted ?> </h3>
                <?php } ?>

                <h3> Click <a href="../../CareerDayMentors.pdf" download>here</a> to read about the mentors.</h3>
                <h3> Email <a href="mailto:micpin@bergen.org"> Ms. Pinke </a> with any questions.</h3>
            <?php } else { ?>
                <h1>Mimic User Mode</h1>
            <?php } ?>
        </div>
    </div>
    <div class="view-signup enrollment">
        <div class="vertical-center">
            <?php foreach ($sessions as $session) { ?>

                <?php if ($registrationOpen || isset($_SESSION['prev_usr_id'])) { ?>
                    <a href="../register/index.php?session=<?php echo $session['ses_times'] ?>&action=register">
                <?php } ?>

                <div class="session view-session" onclick="">
                    <div class="session-number"><?php echo $session['ses_times'] ?></div>
                    <div class="time"><?php echo $session['ses_start'] ?></div>
                    <?php if ($session['ses_id'] != NULL) { ?>
                        <div class="room-number">RM <?php echo $session['pres_room'] ?></div>
                        <div class="session-title"><?php echo $session['mentor_company'] ?></div>
                        <div class="name"><?php echo $session['mentor_last_name'] ?>
                            , <?php echo $session['mentor_first_name'] ?></div>
                    <?php } ?>
                </div>

                <?php if ($registrationOpen || isset($_SESSION['prev_usr_id'])) { ?>
                    </a>
                <?php } ?>


            <?php } ?>
        </div>
    </div>
</section>
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery.easing.min.js"></script>
<script type="text/javascript" src="../js/jquery.plusanchor.min.js"></script>
<script type="text/javascript">
    $('body').plusAnchor({
        easing: 'easeInOutExpo',
        speed: 700
    });
</script>
</body>
</html>
=======
<html>
<head>
    <title>Student Side</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <!-- Styles -->
    <link href="../admin/ss/main.css" rel="stylesheet">
    <!--Above file doesn't exist yet, copy it from career day later-->
</head>
<body>
<main>
    <header><h1 class="title"><h2>Student Side</h1>
        <div id="logout"><a href="../index.php?action=logout">Log Out</a></div>
    </header>
    <br>
    <div class="feature">
        <h3>When I'm available: <a href="./index.php?action=modify_times">Modify</a></h3>
        <p>There will be a list of available times here</p></div>
    <div class="feature">
        <h3>I want to take: <a href="./index.php?action=modify_courses">Modify</a></h3>
        <p>There will be a list of courses here</p></div>


    <!-- should probably be /index.php?action=logout in the final, but that won't work right on localhost since everything's in bca-apps rn -->
</main>
</body>
</html>

>>>>>>> 0df83cfd13f2c74bff6cd6204d2803ed3fba473a
