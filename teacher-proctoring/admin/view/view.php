<html lang="en">
<head>
    <title>Admin View</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <!-- <link rel="shortcut icon" href="images/logo.ico"> -->

    <!-- Styles -->
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,700' rel='stylesheet' type='text/css'>
    <link href="styles.css<?php echo(getVersionString()); ?>" rel="stylesheet">
    <script src="../js/jquery.min.js<?php echo(getVersionString()); ?>"></script>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <?php include_analytics(); ?>
</head>
<body>
<section class="main view">
    <div class="view-signup enrollment">

        <div id="test-table" style="overflow-y:scroll;">
            <div class="test view-test" onclick="">
                <div class="time table-header">Time</div>
                <div class="mods table-header">Mods</div>
                <div class="name table-header">Name</div>
            </div>
            <?php foreach ($testList as $test) { ?>
                <div class="test view-test" onclick="">

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
<script type="text/javascript" src="../js/jquery.min.js<?php echo(getVersionString()); ?>"></script>
<script type="text/javascript" src="../js/jquery.easing.min.js<?php echo(getVersionString()); ?>"></script>
<script type="text/javascript" src="../js/jquery.plusanchor.min.js<?php echo(getVersionString()); ?>"></script>
<script type="text/javascript">
    $('body').plusAnchor({
        easing: 'easeInOutExpo',
        speed: 700
    });
</script>
</body>
</html>
