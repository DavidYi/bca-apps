<html lang="en">
<head>
    <title>Register for Proctoring</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <!-- <link rel="shortcut icon" href="images/logo.ico"> ->

    <!--Styles-->
    <link href="../ss/main.css" rel="stylesheet">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <?php include_analytics(); ?>
</head>
<body>
<section class="main view">
    <div class="view-main">
        <div class="login-status">
            <h3><b><?php echo($user->usr_first_name . " " . $user->usr_last_name); ?></b></h3>
            <h3 class="log-out"><a href="./index.php?action=logout">
                    <?php if (isset($_SESSION['prev_usr_id'])) { ?> Return to Admin Panel <?php } else { ?> Log Out <?php } ?>
                </a></h3>
        </div>
        <div class="vertical-center">
            <?php if (!isset($_SESSION['prev_usr_id'])) { ?>
                <h1>Register For Proctoring</h1>
                <h3> Email <a href="mailto:viclyn@bergen.org"> Mr. Lynch </a> with any questions.</h3>
            <?php } else { ?>
                <h1>Mimic User Mode</h1>
            <?php } ?>
        </div>
    </div>
    <div class="view-signup enrollment">
        <h3></h3>
        <h7>These are your current registration times: </h7>
        <div id="" style="overflow-y:scroll; height:400px; margin-top:25px">
            <?php foreach ($testSelectedList as $test) { ?>
                <div class="session view-session" onclick="">
                    <?php if ($test['test_id'] != NULL) { ?>
                        <div class="time"><?php echo $test['test_dt']?></div>
                        <div class="mods"><?php echo $test['test_time_desc']?></div>
                        <div class="name"><?php echo $test['test_name']?></div>

                    <?php } ?>
                </div>
            <?php } ?>


        </div>
        <h1></h1>
        <form action=""." method="post">
            <input type="hidden" name="action" value="show_itinerary">
            <br>
            <button type = "submit" value="Add/Delete">Add/Delete</button>
        </form>

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
