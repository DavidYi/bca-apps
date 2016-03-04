<html lang="en">
	<head>
		<title>Career Day Registration</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<!-- <link rel="shortcut icon" href="images/logo.ico"> -->

		<!-- Styles -->
		<link href="/<?php echo $app_url_path; ?> /ss/main.css" rel="stylesheet">
		<!-- <?php include_analytics(); ?> -->
	</head>
	<body>
		<form action="<?php echo $next_page ?>" method="get">
		<section class="main login">
			<div class="error">
				<div class="vertical-center">
	                <h1><i>oops...</i></h1>
	                <h3><i>
	                	<?php echo $message ?>
	                </i></h3>
	                <button>Ok</button>
	            </div>
			</div>
		</section>
			</form>
		<script type="text/javascript" src="/<?php echo $app_url_path; ?> /js/jquery.min.js"></script>
		<script type="text/javascript" src="/<?php echo $app_url_path; ?> /js/jquery.easing.min.js"></script>
		<script type="text/javascript" src="/<?php echo $app_url_path; ?> /js/jquery.plusanchor.min.js"></script>
		<script type="text/javascript">
		    $('body').plusAnchor({
		        easing: 'easeInOutExpo',
		        speed:  700
		    });

		</script>
	</body>
</html>