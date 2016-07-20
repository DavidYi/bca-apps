<html lang="en">
<head>
    <title>Admin Test List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <!-- <link rel="shortcut icon" href="images/logo.ico"> -->

    <!-- Styles -->
    <link href="../../ss/main.css" rel="stylesheet">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <?php include_analytics(); ?>
    <style>
        .makeDefault {
            background: #f7f7f7;
            pointer-events: auto;
            -moz-transition : background 0.8s ease 0s;
            -webkit-transition : background 0.8s ease 0s;
            transition : background 0.8s ease 0s;
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

    </style>
</head>
<body>
<section class="main">
    <header>
        <h1 class="title main-title">Admin Test List</h1>
            <a href="../add/index.php">
            <button type="submit" id="add_button" name="add_button">Add Test</button>
            </a>
    </header>

    <nav class="navbar" style="width:85%;">
        <a href="index.php?action=<?php echo $action ?>&sort=1&order=<?php if ($sort_order == 1 && $sort_by == 1) { echo 2; } else { echo 1; } ?>">
            <div class="session-filter tag" style="width:40%;text-align:left">Test Name</div>
        </a>
        <a href="index.php?action=<?php echo $action ?>&sort=2&order=<?php if ($sort_order == 1 && $sort_by == 2) { echo 2; } else { echo 1; } ?>">
            <div class="session-filter company" style="width:15%;text-align:left">Mods</div>
        </a>
        <a href="index.php?action=<?php echo $action ?>&sort=3&order=<?php if ($sort_order == 1 && $sort_by == 3) { echo 2; } else { echo 1; } ?>">
            <div class="session-filter position" style="width:20%;text-align: left">Time</div>
        </a>
        <a href="index.php?action=<?php echo $action ?>&sort=4&order=<?php if ($sort_order == 1 && $sort_by == 4) { echo 2; } else { echo 1; } ?>">
            <div class="session-filter presenter" style="width:12.5%;text-align: left">Needed</div>
        </a>
        <a href="index.php?action=<?php echo $action ?>&sort=5&order=<?php if ($sort_order == 1 && $sort_by == 5) { echo 2; } else { echo 1; } ?>">
            <div class="session-filter remaining" style="text-align: right">Current</div>
        </a>
    </nav>


    <div class="enrollment">
        <?php foreach ($testList as $test) { ?>
            <div class="main-panel" style="position: relative;">
                <a class="default-link" style="position: absolute; width: 100%; height: 100%; z-index: 1;" href="../modify_delete/index.php?action=list_test&test_id=<?php echo $test['test_id']?>">
                <div class="session makeDefault" style="position:relative">
                    <div class="tag"><a class="info" style="float: left; position: relative; z-index: 9; color: #555555;" onclick="popup('#B<?php echo $test['test_id']?>,#P<?php echo $test['test_time_id']?>')">&#x271A;&#xa0;&nbsp;</a><?php echo $test['test_name']?></div>
                    <div class="company"><?php echo $test['test_time_desc']?></div>
                    <div class="position" style="width:20%"><?php echo $test['test_dt']?></div>
                    <div class="presenter" style="width:5%; text-align: right"><?php echo $test['proc_needed']?></div>
                    <div class="remaining" style="width:20%; text-align: right"><?php echo $test['proc_enrolled']?></div>
                </div>
                </a>

                <div class="popup-bg" id="B<?php echo $test['test_id']?>" style="display: none;
                            opacity: 0.7;
                            background: #000;
                            width: 100%;
                            height: 100%;
                            z-index: 10;
                            top: 0;
                            left: 0;
                            position: fixed;">
                </div>

                <div class="popup" id="P<?php echo $test['test_time_id']?>">
                    <div class="entpop">
                        <div class="close">
                            <div class="presname"><?php echo $test['test_name']?></div>
                            <div class="x"><a href="#" style="color:#f0c30f" onclick="cpopup('#B<?php echo $test['test_id']?>,#P<?php echo $test['test_time_id']?>')">&#x2716;</a></div>
                        </div>
                        <div class="popup-c">
                            <h3><?php echo $test['test_dt']?>, <?php echo $test['test_time_desc'];?></h3>
                            <p><?php $id = $test['test_id'] . ', ' . $test['test_time_id'];
                                foreach ($teacher_data[$id] as $teacher) {
                                    echo $teacher['usr_last_name'] . ', ' . $teacher['usr_first_name'] . "<BR>";
                                }?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</section>
<script type="text/javascript" src="../../js/popup.js"></script>
<script type="text/javascript" src="../../js/cpopup.js"></script>
<script type="text/javascript" src="../../js/jquery.min.js"></script>
<script type="text/javascript" src="../../js/jquery.easing.min.js"></script>
<script type="text/javascript" src="../../js/jquery.plusanchor.min.js"></script>
<script type="text/javascript">
    $('body').plusAnchor({
        easing: 'easeInOutExpo',
        speed:  700
    });
</script>
</body>
</html>