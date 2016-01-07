<html lang="en">
	<head>
		<title>Career Day 2015 Registration</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<!-- <link rel="shortcut icon" href="images/logo.ico"> -->

		<!-- Styles -->
        <link href="ss/main.css" rel="stylesheet">
	</head>
	<body>
		<section class="main login">
			<div class="login-intro">
				<div class="vertical-center">
	                <h1>Career Day</h1>

					<h2>
					<?php echo $message ?>
					</h2>

	            </div>
			</div>
            <div class="login-main">
            	<div class="vertical-center">
	                <h1>Login</h1>
					<form action="login_index.php" method="post">
						<input type="hidden" name="action" value="login">

						<input type="text" name="username" placeholder="username">
	                    <input type="password" name="password" placeholder="password">
						<button>Login</button>
	                </form>
            	</div>
            </div>
		</section>
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