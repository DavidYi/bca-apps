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
    <style>

        .makeActive {
            background: #00b8e6;
        }

        .makeDef {
            background: #f7f7f7;
        }

        .enrollment .session:hover {
            background: #cce6ff;
        }

        button {
            background-color: #00b8e6;
            position: absolute;
            left: 70%;
            top: 40%;
        }
    </style>
    <!--comment-->
</head>
<body>
<section class="main">
    <header>
        <h1 class="title main-title" style="">Register for Proctoring</h1>
        <form action="index.php" method="post">
            <input type="hidden" name="action" value="change_user_tests">
            <button type="submit" id="submit_button"
                    name="submit_button" value="">Submit Changes</button>
        </form>

    </header>

    <nav class="navbar">
        <div class="session-filter tag">Test Name</div>
        <div class="session-filter company">Test Type</div>
        <div class="session-filter position">Mods</div>
        <div class="session-filter presenter">Time</div>
        <div class="session-filter remaining">Remaining</div>
    </nav>


    <div class="enrollment" data-value="">
        <!-- here -->
        <!--Comment-->
        <?php foreach ($testList as $test) {
            $testText = $test['test_id'] . ":" . $test['test_time_id'];
            $proc_left = intval($test['proc_needed']) - intval($test['proc_enrolled']);
            ?>
                <div class="session" data-value="<?php echo $testText?>">
                        <div class="tag"><?php echo $test['test_name']?></div>
                        <div class="company"><?php echo $test['test_type_cde']?></div>
                        <div class="position"><?php echo $test['test_time_desc']?></div>
                        <div class="presenter"><?php echo $test['test_dt']?></div>
                        <div class="remaining"><?php echo $proc_left?></div>
                </div>
            <?php } ?>
        <?php ?>
    </div>
</section>
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery.easing.min.js"></script>
<script type="text/javascript" src="../js/jquery.plusanchor.min.js"></script>
<script type="text/javascript">
    var picked = [];
    $('body').plusAnchor({
        easing: 'easeInOutExpo',
        speed:  700
    });

    $('.enrollment .session').on('click', function() {
        $(this).toggleClass("makeActive", "makeDef");
        $(this).css({
                '-moz-transition' : 'background 0.8s ease 0s',
                '-webkit-transition' : 'background 0.8s ease 0s',
                'transition' : 'background 0.8s ease 0s'
        });

        var tData = $(this).data('value');
        if ($(this).hasClass('makeActive')) {
            picked.push(tData);
            console.log("Added: " + tData);
        } else {
            picked.splice(picked.indexOf(tData), 1);
            console.log("Removed: " + tData);
        }
        $("#submit_button").attr('value', picked);
        console.log("Tests: " + picked.toString());
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
