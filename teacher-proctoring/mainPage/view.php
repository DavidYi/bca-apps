<html lang="en">
	<head>
		<title>Teacher Proctoring Registration</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<!-- <link rel="shortcut icon" href="images/logo.ico"> -->

		<!-- Styles
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
		<link rel="icon" href="/favicon.ico" type="image/x-icon">
        <link href="../ss/main.css" rel="stylesheet"> -->
		<?php include_analytics(); ?>
	</head>
	<body>
		<section class="main view">
			<div class="view-main">
			<div class="login-status">
				<h3><b><?php echo ($user->usr_first_name." ".$user->usr_last_name); ?></b></h3>
				<h3 class="log-out"><a href="./index.php?action=logout">
                        <?php if (isset($_SESSION['prev_usr_id'])) { ?> Return to Admin Panel <?php }
                        else { ?> Log Out <?php } ?>
                    </a></h3>
			</div>
			<div class="vertical-center">
                <?php if (!isset($_SESSION['prev_usr_id'])) { ?>
                    <h1>Teacher Proctoring (Feb. 2)</h1>

    <?php if ($startTime > $currentTime) { ?>
                    <h3> Registration <b>has not opened</b>!</h3>
                    <h3> Opens: <?php echo $startTimeFormatted ?> </h3>

    <?php } elseif ($endTime < $currentTime) { ?>
                    <h3> Registration has <b>ended</b>. </h3>
                    <h3> If you did not finish registering, a session will be assigned to you. </h3>

    <?php } elseif ($registration_complete) { ?>
                    <h3> Registration <b>complete</b>! </h3>
                    <h3> Feedback <a href="https://docs.google.com/forms/d/1nfzkqn2NB8m8OeQ_w3XwE2hNp3OK-k8bVtA6DZb300E/viewform">survey</a> about this site. </h3>

    <?php } else { ?>
                    <h3> Registration is <b>open</b>! </h3>
                    <h3> Closes: <?php echo $endTimeFormatted ?> </h3>
    <?php } ?>

                    <h3> Email <a href="mailto:viclyn@bergen.org"> Mr. Lynch </a> with any questions.</h3>
                <?php } else { ?>
                    <h1>Mimic User Mode</h1>
                <?php } ?>
			</div>
			</div>
			<div class="view-signup enrollment">
			<div class="vertical-center">
				<?php foreach ($sessions as $session) { ?>

					<?php if ($registrationOpen || isset($_SESSION['prev_usr_id'])) {?>
						<a href="../register/index.php?session=<?php echo $session['test_times']?>&action=register">
					<?php } ?>

					<div class="session view-session" onclick="">
						<div class="test-type"><?php echo $session['test_type_cde'] ?></div>
						<?php if ($session['test_id'] != NULL) { ?>
						<div class="rm_nbr">RM <?php echo $session['rm_nbr'] ?></div>
						<div class="test-name"><?php echo $session['test_name'] ?></div>
						<div class="time"><?php echo $session['test_time_id']?>, <?php echo $session['test_dt'] ?></div>
                            <?php include ("./delete.php"); ?>
                        <?php } ?>
					</div>


					<?php if ($registrationOpen || isset($_SESSION['prev_usr_id'])) {?>
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
		        speed:  700
		    });
		</script>
	</body>
</html>