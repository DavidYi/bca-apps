<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Career Day 2015 Registration</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<!-- <link rel="shortcut icon" href="images/logo.ico"> -->

		<!-- Styles -->
        <link href="ss/main.css" rel="stylesheet">

        <?php include_analytics(); ?>
    </head>
	<body>
		<section class="main">
			<header>
				<h1 class="title main-title">Register for Career Day</h1x>
			</header>

			<nav class="navbar">
				<div class="session-select <?php if ($currentSession == 1) { echo 'active'; }?>"><a href="index.php?session=1">Session 1</a></div><div class="session-select <?php if ($currentSession == 2) { echo 'active'; }?>"><a href="index.php?session=2">Session 2</a></div><div class="session-select <?php if ($currentSession == 3) { echo 'active'; }?>"><a href="index.php?session=3">Session 3</a></div><div class="session-select <?php if ($currentSession == 4) { echo 'active'; }?>"><a href="index.php?session=4">Session 4</a></div>
				<!-- <form class="searchbar"><input type="text" class="search-input" placeholder="Search"></form> -->
			</nav>

			<div class="enrollment">
				<?php foreach ($presentations as $presentation) {?>
				<div class="session">
					<div class="tag"><?php echo strtoupper($presentation['mentor_field'])?></div>
					<div class="title">
						<span style="vertical-align: middle;">
							<h3><?php echo $presentation['mentor_company'] ?></h3>
							<h5>
                                <?php echo $presentation['mentor_first_name'] . " " .
                                    $presentation['mentor_last_name'] . ", " .
                                    $presentation['mentor_position'] ?>
                            </h5>
						</span>
					</div>
					<div class="room">RM 138</div>
					<div class="remaining">7 / 30</div>
				</div>
				<?php } ?>
			</div>
<!--			<div class="register">-->
<!--				<button type="button" class="resister-button">Register</button>-->
<!--			</div>-->
		</section>
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.easing.min.js"></script>
		<script type="text/javascript" src="js/jquery.plusanchor.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
			    $('body').plusAnchor({
			        easing: 'easeInOutExpo',
			        speed:  700
			    });
			});
		</script>
	</body>
</html>