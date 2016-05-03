<html lang="en">
<head>
    <title><?php echo $app_title?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <!-- <link rel="shortcut icon" href="images/logo.ico"> -->

    <!-- Styles -->
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link href="../ss/main.css" rel="stylesheet">
    <?php include_analytics(); ?>
</head>
<body>

<section class="main view">
    <div class="view-main">
        <div class="login-status">
            <h3><b><?php echo($user->usr_first_name . " " . $user->usr_last_name); ?></b></h3>
            <h3 class="log-out"><a href="./index.php?action=logout">Log Out</a></h3>
        </div>
        <div class="vertical-center">
            Teacher Page!

            Instructions here.
        </div>
    </div>
    <div class="view-signup enrollment">
        <div class="vertical-center">
            <h3><b>Availability</b></h3>
            Show availability table here
            <a href="availability/availability_view.php">Modify Availability</a>
        </div>
        <div class="vertical-center">
            <h3><b>Courses</b></h3>
            Show course list table here
            <a href="teacher_add_course">Add Class</a>
        </div>
    </div>
</section>





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