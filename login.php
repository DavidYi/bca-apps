<html lang="en">
	<head>
		<title>Career Day Registration</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<!-- <link rel="shortcut icon" href="images/logo.ico"> -->

		<!-- Styles -->
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
		<link rel="icon" href="/favicon.ico" type="image/x-icon">
        <link href="ss/main.css" rel="stylesheet">
	</head>
	<body>
		<section class="main login">
			<div class="login-intro">
				<div class="vertical-center">
	                <h1>Career Day</h1>
	                <h3>
						BCA will hold Career Day on <b>Tuesday, February 2</b>.  At Career Day, you will have the opportunity
						to participate in presentations by 4 different mentors of your choosing.  Through this experience,
						our hope is that you can gain insight into the variety and types of career paths available to you.
					</h3>
					<h3 style="color:red">
						<?php echo $message ?>
					</h3>

	            </div>
			</div>
            <div class="login-main">
            	<div class="vertical-center">
	                <h1>Login</h1>
					<form action="." method="post">
						<input type="hidden" name="action" value="login">

						<input type="text" name="username" placeholder="username">
	                    <input type="password" name="password" placeholder="password">
						<button>Login</button>
	                </form>

					<img src="images/logo.svg" alt="">
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