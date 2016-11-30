<html lang="en">
<head>
    <title>Admin Test List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <!-- <link rel="shortcut icon" href="images/logo.ico"> -->

    <!-- Styles -->
    <link href="../../ss/main.css<?php echo(getVersionString()); ?>" rel="stylesheet">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <?php include_analytics(); ?>
    <style>
        .makeDefault {
            background: #f7f7f7;
            pointer-events: auto;
            -moz-transition: background 0.8s ease 0s;
            -webkit-transition: background 0.8s ease 0s;
            transition: background 0.8s ease 0s;
        }

        .enrollment .session:hover {
            background: #ffd633;
        }

        button {
            background-color: #ffcc00;
            position: absolute;
            left: 70%;
            top: 40%;
        }

        #pdf {
            float: left;
            position: relative;
            z-index: 9;
            height: 80%;
            vertical-align: middle;
            display: inline-block;
            padding-top: 7%;
        }

        .filter-off {
            background-color: #ffffff;
            color: #ffcc00;
            border: 1px solid #ffcc00;
        }
    </style>
</head>
<body>
<section class="main">
    <header>
        <h1 class="title main-title">Admin Test List</h1>
        <form action="index.php" method="post">
            <input type="hidden" name="action" value="list_admin_tests">
            <button style="left: 30%; width: 9em;"
                    type="submit" id="past_button" class="filter-off"
                    name="past_button"
                    value="Past Selected"
                    data-value=<?php echo $past_num ?>>Include Past Sessions
            </button>
        </form>
        <a href="../add/index.php">
            <button type="submit" id="add_button" name="add_button">Add Test</button>
        </a>
        <a href="../index.php">
            <button style="left: 15%"
                    type="submit" id="return_button" name="return_button">Return to Admin Panel
            </button>
        </a>
    </header>

    <nav class="navbar" style="width:85%;">
        <a href="index.php?action=<?php echo $action ?>&sort=1&order=<?php if ($sort_order == 1 && $sort_by == 1) {
            echo 2;
        } else {
            echo 1;
        } ?>">
            <div class="session-filter tag" style="width:20%;text-align:left">Test Name</div>
        </a>
        <a href="index.php?action=<?php echo $action ?>&sort=3&order=<?php if ($sort_order == 1 && $sort_by == 3) {
            echo 2;
        } else {
            echo 1;
        } ?>">
            <div class="session-filter company" style="width:15%;text-align:left">Mods</div>
        </a>

        <!--        ROOM -->
        <a href="index.php?action=<?php echo $action ?>&sort=8&order=<?php if ($sort_order == 1 && $sort_by == 8) {
            echo 2;
        } else {
            echo 1;
        } ?>">
            <div class="session-filter company" style="width:15%;text-align:left">Room</div>
        </a>

        <a href="index.php?action=<?php echo $action ?>&sort=4&order=<?php if ($sort_order == 1 && $sort_by == 4) {
            echo 2;
        } else {
            echo 1;
        } ?>">
            <div class="session-filter position" style="width:10%;text-align: left">Date</div>
        </a>
        <a href="index.php?action=<?php echo $action ?>&sort=6&order=<?php if ($sort_order == 1 && $sort_by == 6) {
            echo 2;
        } else {
            echo 1;
        } ?>">
            <div class="session-filter presenter" style="width:6.5%;text-align: right">Total</div>
        </a>
        <a href="index.php?action=<?php echo $action ?>&sort=7&order=<?php if ($sort_order == 1 && $sort_by == 7) {
            echo 2;
        } else {
            echo 1;
        } ?>">
            <div class="session-filter remaining" style="width:13%;text-align: right">Current</div>
        </a>
        <a href="index.php?action=<?php echo $action ?>&sort=5&order=<?php if ($sort_order == 1 && $sort_by == 5) {
            echo 2;
        } else {
            echo 1;
        } ?>">
            <div class="session-filter proctorsleft" style="width:15%;text-align: right">Remaining</div>
        </a>
    </nav>


    <div class="enrollment">
        <form name="test" action="." method="post">
            <?php $test_num = 0 ?>
            <?php foreach ($testList as $test) { ?>
                <input type="hidden" name="action" value="<?php echo 'listpdf' ?>">
                <input type="hidden" name="test_id" id="test_id_input">
                <div class="main-panel" style="position: relative;">
                    <a class="default-link" style="position: absolute; width: 100%; height: 100%; z-index: 1;"
                       href="../modify_delete/index.php?action=list_test&test_id=<?php echo $test['test_id'] ?>">
                        <div class="session makeDefault" style="position:relative">
                            <div class="tag" style="width:20%">

                                <a id="pdf" target="_blank" onclick="listPDF(<?php echo $test['test_id'] ?>);">
                                    <img src="../../../shared/images/pdf.png" id="pdf">
                                </a>
                                <?php echo $test['test_name'] ?>
                            </div>
                            <div class="company" style="width:15%"><?php echo $test['test_time_desc'] ?></div>
                            <div class="company" style="width:15%"><?php echo $test['rm_nbr'] ?></div>
                            <div class="position" style="width:10%"><?php echo $test['test_dt'] ?></div>

                            <div class="presenter"
                                 style="width:6.5%; text-align: right"><?php echo $test['proc_needed'] ?></div>

                            <div class="remaining"
                                 style="width:13%; text-align: right"><?php echo $test['proc_enrolled'] ?></div>

                            <a class="info"
                               style="padding-left: 10px; float: left; position: relative; z-index: 9; color: #555555;"
                               onclick="popup('#B<?php echo $test_num ?>,#P<?php echo $test_num ?>')">
                                &#x271A;&#xa0;&nbsp;</a>

                            <div class="proctorsleft"
                                 style="width: 15%; text-align:right"><?php echo $test['remaining'] ?></div>
                        </div>
                    </a>

                    <div class="popup-bg" id="B<?php echo $test_num ?>" style="display: none;
                            opacity: 0.7; background: #000; width: 100%;
                            height: 100%; z-index: 10; top: 0;
                            left: 0; position: fixed;">
                    </div>

                    <div class="popup" id="P<?php echo $test_num ?>">
                        <div class="entpop">
                            <div class="close">
                                <div class="presname"><?php echo $test['test_name'] ?></div>
                                <div class="x"><a href="#" style="color:#f0c30f"
                                                  onclick="cpopup('#B<?php echo $test_num ?>,#P<?php echo $test_num ?>')">
                                        &#x2716;</a></div>
                            </div>
                            <div class="popup-c">
                                <h3><?php echo $test['test_dt'] ?>, <?php echo $test['test_time_desc']; ?></h3>
                                <p><?php $id = $test['test_id'] . ', ' . $test['test_time_id'];
                                    foreach ($teacher_data[$id] as $teacher) {
                                        echo $teacher['usr_last_name'] . ', ' . $teacher['usr_first_name'] . "<BR>";
                                    } ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $test_num++ ?>
            <?php } ?>
        </form>
    </div>
</section>
<script type="text/javascript" src="../../js/listPDF.js<?php echo(getVersionString()); ?>"></script>
<script type="text/javascript" src="../../js/popup.js<?php echo(getVersionString()); ?>"></script>
<script type="text/javascript" src="../../js/cpopup.js<?php echo(getVersionString()); ?>"></script>
<script type="text/javascript" src="../../js/jquery.min.js<?php echo(getVersionString()); ?>"></script>
<script type="text/javascript" src="../../js/jquery.easing.min.js<?php echo(getVersionString()); ?>"></script>
<script type="text/javascript" src="../../js/jquery.plusanchor.min.js<?php echo(getVersionString()); ?>"></script>
<script type="text/javascript">
    $('body').plusAnchor({
        easing: 'easeInOutExpo',
        speed: 700
    });

    $(document).ready(function () {
        if ($("#past_button").data('value') == 1) {
            $("#past_button").removeClass('filter-off');
        }

        if ($(".remaining").text != 0) {
            $(".info").show();
        } else {
            $(".info").hide();
        }
    });
</script>

</body>
</html>