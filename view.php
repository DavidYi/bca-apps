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
				<h1 class="title main-title">Register for Career Day</h1>
			</header>

			<nav class="navbar">
                <a href="index.php?session=1">
                    <div class="session-select">
                        Session 1
                    </div>
                </a>
                <a href="index.php?session=2">
                    <div class="session-select">
                        Session 2
                    </div>
                </a>
                <a href="index.php?session=3">
                    <div class="session-select">
                        Session 3
                    </div>
                </a>
                <a href="index.php?session=4">
                    <div class="session-select">
                        Session 4
                    </div>
                </a>
				<!-- <form class="searchbar"><input type="text" class="search-input" placeholder="Search"></form> -->
			</nav>

			<div class="enrollment">
                <?php foreach ($presentations as $presentation) {
                    if ($presentation['pres_max_capacity'] > $presentation['pres_enrolled_count'] || ($is_enrolled && $pres_enrolled == $presentation['pres_id'])) { ?>
                        <div class="session">
                            <div class="tag"> <?php echo $presentation['mentor_field'] ?> </div>
                            <div class="title">
                                <span style="vertical-align: middle;">
                                    <h3> <?php echo $presentation['mentor_company'] ?> </h3>
                                    <h5>
                                        <?php echo $presentation['mentor_first_name'];
                                              echo ' ' . $presentation['mentor_last_name'];
                                              echo ', ' . $presentation['mentor_position']; ?>
                                    </h5>
                                </span>
                            </div>
                            <div class="remaining"><?php echo $presentation['pres_enrolled_count']; ?> / <?php echo $presentation['pres_max_capacity']; ?> </div>
                        </div>
                     <?php }
                } ?>
			</div>
			<!-- <div class="register">
				<button type="button" class="resister-button">Register</button>
			</div> -->
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