<html lang="en">
	<head>
		<title><?php echo pageTitle ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<!-- <link rel="shortcut icon" href="images/logo.ico"> -->

		<!-- Styles -->
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
		<link rel="icon" href="/favicon.ico" type="image/x-icon">
        <link href="./ss/main.css" rel="stylesheet">
	</head>
	<body>
		<section class="main login">
			<div class="login-intro">
				<div class="vertical-center">
					<?php echo $loginInfo ?>

	            </div>
			</div>
            <div class="login-main">
            	<div class="vertical-center">
	                <h1>Login</h1>
					<form action="." method="post">
						<input type="hidden" name="action" value="login">

						<h3 style="color:red">
							<?php echo $message ?>
						</h3>

						<input type="text" name="username" placeholder="username">
	                    <input type="password" name="password" placeholder="password">
						<button>Login</button>
	                </form>
            	</div>
            </div>
		</section>
		<script type="text/javascript" src="../career-day/js/jquery.min.js"></script>
		<script type="text/javascript" src="../career-day/js/jquery.easing.min.js"></script>
		<script type="text/javascript" src="../career-day/js/jquery.plusanchor.min.js"></script>
		<script type="text/javascript">
		    $('body').plusAnchor({
		        easing: 'easeInOutExpo',
		        speed:  700
		    });

		</script>
	</body>
</html>