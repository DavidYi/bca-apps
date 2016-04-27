<html lang="en">
<head>
    <title>Register for Proctoring</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <!-- <link rel="shortcut icon" href="images/logo.ico"> -->

    <!-- Styles -->
    <link href="../ss/main.css" rel="stylesheet">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <?php include_analytics(); ?>
</head>
<body>
<section class="main">
    <header>
        <h1 class="title main-title">Register for Proctoring</h1>
    </header>

    <nav class="navbar">
        <div class="session-filter tag">Test Name</div>
        <div class="session-filter company">Test Type</div>
        <div class="session-filter position">Room</div>
        <div class="session-filter presenter">Time</div>
        <div class="session-filter remaining">Actions</div>
    </nav>

    <div class="enrollment">
        <!-- here -->
        <!--Comment-->

        <?php foreach ($testList as $test) { ?>
                <div class="session">
                        <div class="tag"><?php echo $test['test_name']?></div>
                        <div class="company"><?php echo $test['test_type_cde']?></div>
                        <div class="position"><?php echo $test['rm_id']?></div>
                        <div class="presenter"><?php echo $test['test_dt']?></div>
                        <div class="remaining"><img src="../images/Trash_Can-256.png"
                                                    onclick="deleteCourse(<?php echo $test['test_id']; ?>);"
                                                    title="Delete Test"
                                                    style="cursor:pointer" class="trash"></div>
                </div>
            <?php } ?>
    </div>
</section>
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery.easing.min.js"></script>
<script type="text/javascript" src="../js/jquery.plusanchor.min.js"></script>
<script>
    function register_for(pres_id) {
        alert ("Hello");
        $(location).attr('href', );
    }
</script>
<script type="text/javascript">
    $('body').plusAnchor({
        easing: 'easeInOutExpo',
        speed:  700
    });

    /*
     function postRegister(postObject) {
     $.post(
     "/index.php",
     {
     "pres_id": postObject
     },
     function (data) {
     data = $.parseJSON(data);
     },
     "json"
     );
     });
     */

</script>
</body>
</html>
