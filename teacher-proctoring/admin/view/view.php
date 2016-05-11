<html lang="en">
<head>
    <title>Admin View</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <!-- <link rel="shortcut icon" href="images/logo.ico"> -->

    <!-- Styles -->
    <link href="../ss/main.css" rel="stylesheet">
    <script src="../js/jquery.min.js"></script>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <?php include_analytics(); ?>
</head>
<body>
<section class="main view">
    <div class="view-signup enrollment">

        <div id="" style="overflow-y:scroll; height:500px; margin-top:45px">
            <?php foreach ($testList as $test) { ?>
                <div class="session view-session" onclick="">
                    <?php if ($test['test_id'] != NULL) { ?>
                        <div class="time"><?php echo $test['test_dt'] ?></div>
                        <div class="mods"><?php echo $test['test_time_desc'] ?></div>
                        <div class="name"><?php echo $test['test_name'] ?></div>

                    <?php } ?>
                    <!--comment-->
                </div>
            <?php } ?>

        </div>
    </div>

</section>
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery.easing.min.js"></script>
<script type="text/javascript" src="../js/jquery.plusanchor.min.js"></script>
<script type="text/javascript">
    $('body').plusAnchor({
        easing: 'easeInOutExpo',
        speed: 700
    });
</script>
</body>
</html>
