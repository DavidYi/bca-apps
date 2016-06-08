<html>
<head>
    <title>Student Side</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <!-- Styles comment so i can push -->

    <link href="../ss/main.css" rel="stylesheet">
    <!--Above file doesn't exist yet, copy it from career day later-->
</head>
<body>
<section class="main view">
    <div class="view-main">
        <main>
            <div class="login-status">
                <h3><b><?php echo($user->usr_first_name . " " . $user->usr_last_name); ?></b></h3>
                <h3 class="log-out"><a href="./index.php?action=logout">Log Out</a></h3>
            </div>

            <h2 class="title">Student Side</h2>
            <p> Instructions </p>


            <!-- should probably be /index.php?action=logout in the final, but that won't work right on localhost since everything's in bca-apps rn -->
        </main>
    </div>

    <div class="view-signup enrollment">
        <div class="vertical-center">
            <main>
                <div class="feature">
                    <h3>When I'm available: <a href="index.php?action=modify_times">Modify</a></h3>
                    <p><?php echo($timesString);?></p></div>
                <div class="feature">
                    <h3>I want to take: <a href="index.php?action=modify_courses">Modify</a></h3>
                    <p>There will be a list of courses here</p></div>


                <!-- should probably be /index.php?action=logout in the final, but that won't work right on localhost since everything's in bca-apps rn -->
            </main>
        </div>
    </div>
</section>
</body>
</html>