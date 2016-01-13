<html lang="en">
	<head>
		<title>Career Day Registration</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<!-- <link rel="shortcut icon" href="images/logo.ico"> -->

		<!-- Styles -->
        <link href="../ss/main.css" rel="stylesheet">
		<?php include_analytics(); ?>
	</head>
	<body>
		<section class="main view">
			<div class="view-main">
			<div class="vertical-center">
				<h1>Career Day (Feb. 2)</h1>

<?php if ($startTime > $currentTime) { ?>
				<h3> Registration is <b>closed</b>!</h3>
				<h3> Opens: <?php echo $startTimeFormatted ?> </h3>

<?php } elseif ($endTime < $currentTime) { ?>
				<h3> Registration has <b>ended</b>. </h3>
				<h3> If you did not finish registering, random session will be assigned to you. </h3>

<?php } else { ?>
				<h3> Registration is <b>open</b>! </h3>
				<h3> Closes: <?php echo $endTimeFormatted ?> </h3>
<?php } ?>

				<h3> Click <a href="" download>here</a> to get a complete document about the speakers.</h3>
				<h3> Email <a href="mailto:micpin@bergen.org"> Ms. Pinke </a> with any questions.</h3>
			</div>
			</div>
			<div class="view-signup enrollment">
			<div class="vertical-center">
				<?php foreach ($sessions as $session) { ?>

					<?php if ($registrationOpen) {?>
						<a href="../register/index.php?session=<?php echo $session['ses_times']?>&action=register">
					<?php } ?>

					<div class="session view-session" onclick="">
						<div class="session-number"><?php echo $session['ses_times'] ?></div>
						<div class="time"><?php echo $session['ses_start']?></div>
						<?php if ($session['ses_id'] != NULL) { ?>
						<div class="room-number">RM <?php echo $session['pres_room'] ?></div>
						<div class="session-title"><?php echo $session['mentor_company'] ?></div>
						<div class="name"><?php echo $session['mentor_last_name']?>, <?php echo $session['mentor_first_name'] ?></div>
						<?php } ?>
					</div>

					<?php if ($registrationOpen) {?>
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