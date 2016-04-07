<?php
require_once('../util/main.php');
//require_once('../../util/tags.php');
require_once('../model/senior_db.php');
require_once ('../model/presentations_db.php');

$pres = Presentation::getPresentationForSenior($user->usr_id);

?>

<html lang="en">
<head>
    <title>Senior Experience Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <!-- <link rel="shortcut icon" href="images/logo.ico"> -->

    <!-- Styles -->
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link href="../ss/main.css" rel="stylesheet">
    <?php include_analytics(); ?>
    <style>
        .view .view-signup{
            background-color: #60CE94;
        }
        .add-mdy {
            width: 10em;
            height: 3em;
            border: 2px solid black;
            border-radius: 10%;
            color: #000;
            font-size: 17px;
            font-weight: bold;
            text-align: center;
            display: block;
            margin-top: 20%;
            vertical-align: bottom;
            background-color: #9ace60;
        }
    </style>
</head>
<body>
<section class="main view">
    <div class="view-main">
        <div class="login-status">
            <h3><b><?php echo ($user->usr_first_name . " " . $user->usr_last_name); ?></b></h3>
            <h3 class="log-out"><a href="./index.php?action=logout">Log Out</a></h3>
        </div>
        <div class="vertical-center">
            <h1> Senior Expositions (Jun. 10)</h1>
            <h3> Lorem ipsum dolor sit amet, an albucius probatus eos</h3>

            <h3> Ea nostrud facilis vel, et est facer minim integre.</h3>
            <h3> Velit denique mandamus vel ne. Sed ex odio amet.</h3>
        </div>
    </div>
    <div class="view-signup enrollment">
        <div class="vertical-center">
            <?php if ($pres !== NULL){ ?>
                <h1>My Presentation</h1>
                <h3>Title: <?php echo($pres->pres_title);?></h3>
                <h3>Description: <?php echo($pres->pres_desc);?></h3>
                <h3>Organization: <?php echo($pres->organization);?></h3>
                <h3>Location: <?php echo($pres->location);?></h3>
            <?php } else { ?>
            <h2 style="text-align:center">You have not signed up for a presentation. Please click the button below to sign up for one.</h2>
            <?php } ?>
            <div>
                <form action="." method="post">
                    <input class="add-mdy add" type="submit" value="Add/Modify">
                </form>
            </div>
        </div>
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