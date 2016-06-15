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
        .makeDefault {
            background: #f7f7f7;
            pointer-events: auto;
            -moz-transition : background 0.8s ease 0s;
            -webkit-transition : background 0.8s ease 0s;
            transition : background 0.8s ease 0s;
        }

        .makeActive {
            background: #00b8e6;
            pointer-events: auto;
            -moz-transition : background 0.8s ease 0s;
            -webkit-transition : background 0.8s ease 0s;
            transition : background 0.8s ease 0s;
        }

        .makeDisabled {
            opacity : 0.4;
            pointer-events: none;
            -moz-transition: background 0.8s ease 0s;
            -webkit-transition: background 0.8s ease 0s;
            transition: background 0.8s ease 0s;
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

        .filter-off {
            background-color : #ffffff;
            color : #00b8e6;
            border: 1px solid #00b8e6;
        }
    </style>
</head>
<body>
<section class="main">
    <header>
        <h1 class="title main-title">Register for Proctoring</h1>
        <form action="index.php" method="post">
            <input type="hidden" name="action" value="list_user_tests">
            <button style="left: 10%; width: 9em;"
                    type="submit" id="full_button" class="btn-enabled"
                    name="full_button"
                    value="Full Selected"
                    data-value=<?php echo $full_num?>>Include Full Sessions</button>
            <button style="left: 22%; width: 9em;"
                    type="submit" id="past_button"
                    name="past_button"
                    value="Past Selected"
                    data-value=<?php echo $past_num?>>Include Past Sessions</button>
        </form>
        <form action="index.php" method="post">
            <input type="hidden" name="action" value="change_user_tests">
            <button type="submit" id="submit_button"
                    name="submit_button"
                    value=<?php echo implode(",",$selList)?>>Submit Changes</button>
        </form>
    </header>

    <nav class="navbar">
        <div class="session-filter tag">Test Name</div>
        <div class="session-filter company">Test Type</div>
        <div class="session-filter position">Mods</div>
        <div class="session-filter presenter">Time</div>
        <div class="session-filter remaining">Remaining</div>
    </nav>


    <div class="enrollment">
        <?php foreach ($testList as $test) {
            $testText = $test['test_id'] . ":" . $test['test_time_id'];?>
            <div class="session makeDefault" data-value="<?php echo $testText?>">
                <div class="tag"><?php echo $test['test_name']?></div>
                <div class="company"><?php echo $test['test_type_cde']?></div>
                <div class="position"><?php echo $test['test_time_desc']?></div>
                <div class="presenter"><?php echo $test['test_dt']?></div>
                <div class="remaining"><?php echo $test['remaining']?></div>
            </div>
        <?php } ?>
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

    function checkForSameTimes(newTest, chosenTest) {
        var sameDay = newTest.find('.presenter').text() == chosenTest.find('.presenter').text();
        var sameTime = newTest.find('.position').text() == chosenTest.find('.position').text();
        var isFull = newTest.find('.remaining').text() === '0';
        if (!newTest.is(chosenTest) && !newTest.is('.makeActive') && !newTest.is('.makeDisabled')
            && sameDay && sameTime && !isFull) {
            newTest.toggleClass('makeDefault makeDisabled');
        } else if (newTest.is('.makeDisabled') && sameDay && sameTime && !isFull) {
            newTest.toggleClass('makeDefault makeDisabled');
        }
    }

    $(document).ready(function() {
        if ($("#full_button").data('value') == 0) {
            $("#full_button").addClass('filter-off');
        }
        if ($("#past_button").data('value') == 0) {
            $("#past_button").addClass('filter-off');
        }
        var active_times = $("#submit_button").attr('value');
        if (active_times.length > 0)
            picked = active_times.split(",");
        $('.enrollment .session').each(function() {
            var tData = $(this).data('value');
            if (picked.indexOf(tData) !== -1) {
                $(this).toggleClass("makeActive makeDefault");
                if ($(this).find('.remaining').text() === '0' && !$(this).hasClass("makeActive")) {
                    $(this).toggleClass("makeDefault makeDisabled");
                }
                var chosen = $(this);
                $('.enrollment .session').each(function() {
                    checkForSameTimes($(this), chosen);
                });
            } else {
                if ($(this).find('.remaining').text() === '0') {
                    $(this).toggleClass("makeDefault makeDisabled");
                }
            }
        });
    });

    $('.enrollment .session').on('click', function() {
        var chosen = $(this);
        chosen.toggleClass("makeActive makeDefault");

        var tData = chosen.data('value');
        if (chosen.hasClass('makeActive')) {
            picked.push(tData);
        } else {
            picked.splice(picked.indexOf(tData), 1);
        }
        $("#submit_button").attr('value', picked);
        $('.enrollment .session').each(function() {
            checkForSameTimes($(this), chosen);
        });
    });

</script>
</body>
</html>