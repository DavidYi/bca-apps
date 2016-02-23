<html lang="en">
	<head>
		<title>Career Day Registration</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<!-- <link rel="shortcut icon" href="images/logo.ico"> -->

		<!-- Styles -->
        <link href="../ss/main.css" rel="stylesheet">
		<!-- <?php include_analytics(); ?> -->
	</head>
	<body>
		<form action="/<?php echo $app_url_path; ?>/itinerary" method="get">
		<section class="main login">
			<div class="error">
				<div class="vertical-center">
	                <h1><i>oops...</i></h1>
	                <h3><i>
	                	<?php echo $error_message ?>
	                </i></h3>
	                <button>Back</button>
	            </div>
			</div>
		</section>
			</form>
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.easing.min.js"></script>
		<script type="text/javascript" src="js/jquery.plusanchor.min.js"></script>
		<script type="text/javascript">
		    $('body').plusAnchor({
		        easing: 'easeInOutExpo',
		        speed:  700
		    });

		</script>
	</body>
</html>