<html lang="en">
<head>
    <title>Senior Expositions</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <!-- <link rel="shortcut icon" href="images/logo.ico"> -->

    <!-- Styles -->
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link href="../ss/main.css<?php echo(getVersionString()); ?>" rel="stylesheet">
    <?php // include_analytics(); ?>
</head>
<body>
<section class="main view">
    <div class="view-main">
        <div class="login-status">
            <h3><b><?php echo ($user->usr_first_name . " " . $user->usr_last_name); ?></b></h3>
            <h3 class="log-out"><a href="./index.php?action=logout">Log Out</a></h3>
        </div>
        <div class="vertical-center">
            <h1>Senior Expo</h1>

            <?php if ($startTime > $currentTime) { ?>
                <h3> Registration <b>has not opened</b>!</h3>
                <h3> Opens: <?php echo $startTimeFormatted ?> </h3>

            <?php } elseif ($endTime < $currentTime) { ?>
                <h3> Registration has <b>ended</b>. </h3>
                <h3> If you have not finished registering, sessions will be assigned to you. </h3>

            <?php } elseif ($registration_complete) { ?>
                <h3> Registration <b>complete</b>! </h3>

            <?php } else { ?>
                <h3> Registration is <b>open</b>! </h3>
                <h3> Closes: <?php echo $endTimeFormatted ?> </h3>
            <?php } ?>
            <h3> Click <a href="../../presentation_list.pdf" download>here</a> to see all presentations.</h3>
        </div>
    </div>
    <div class="view-signup enrollment">
        <div class="vertical-center">
            <H1>My Sessions</H1>
            <?php foreach ($sessions as $session) {
                $presenters = $session['full_presenters'];
                if (strlen($presenters) > 30) {
                    $presenters =  $session['presenter_names'];
                }
                ?>

                <?php if ($registrationOpen and ($session['presenting'] != 1)) {?>
                    <a href="../register/index.php?session=<?php echo $session['ses_id']?>&action=register">
                <?php } ?>

                <div class="session view-session" onclick="">
                    <div class="time"><?php echo $session['ses_start']?></div>
                    <?php if ($session['pres_id'] != NULL) { ?>
                        <div class="room-number">RM <?php echo $session['rm_nbr'] ?>&nbsp</div>
                        <div class="session-title"><?php echo $session['organization'] ?>&nbsp</div>
                        <div class="name"><?php echo $presenters?>&nbsp</div>
                    <?php } else {?>
                        <div class="room-number">&nbsp</div>
                        <div class="session-title">Click to register</div>
                    <?php }?>
                </div>

                <?php if ($registrationOpen) {?>
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
        speed:  700
    });
</script>
</body>
</html>