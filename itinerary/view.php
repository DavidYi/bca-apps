<html lang="en">
	<head>
		<title>Career Day 2015 Registration</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<!-- <link rel="shortcut icon" href="images/logo.ico"> -->

		<!-- Styles -->
        <link href="../ss/main.css" rel="stylesheet">
		<?php include_analytics(); ?>
	</head>
	<body>
		<section class="main view">
			<div class="view-main">
				<h1>Career Day</h1>
				<h3>
					BCA will hold Career Day on Tuesday, February 2.  At Career Day, you will have the opportunity
					to participate in presentations by 4 different mentors of your choosing.  Through this experience,
					our hope is that you can gain insight into the variety and types of career paths available to you.
					You have the opportunity to select the presentations ......
				</h3>
				<h3>Registration closes at 8am, on January 28th.  At that time, if you have not completed
					the registration process, you will be randomly assigned to presentations.
				</h3>
			</div>
			<div class="view-signup enrollment">
				<?php foreach ($sessions as $session) { ?>
					<a href="../index.php?session=<?php echo $session['ses_times']?>&action=<?php
						if ($session['ses_id'] != NULL) {
							echo "change";
						} else {
							echo "register";
						}
					?>"> <div class="session view-session" onclick="">
						<div class="session-number">Session <?php echo $session['ses_times'] ?></div>
						<div class="time">
							<?php echo $session['ses_start']?> ~ <?php echo $session['ses_end']?>
						</div>
						<?php if ($session['ses_id'] != NULL) { ?>
						<div class="room-number">RM <?php echo $session['pres_room'] ?></div>
						<div class="session-title"><?php echo $session['mentor_company'] ?></div>
						<div class="name"><?php echo $session['mentor_last_name']?> , <?php echo $session['mentor_first_name'] ?></div>
						<?php } ?>
					</div> </a>
				<?php } ?>
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