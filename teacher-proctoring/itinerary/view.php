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
        }
    </style>
</head>
<body>
<section class="main">
    <header>
        <h1 class="title main-title" style="">Register for Proctoring</h1>
        <button style="position:absolute; top:25%; right:10%;">Submit Changes</button>
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

        <?php foreach ($testList as $test) {
            $testText = $test['test_id'] . ":" . $test['test_time_id'];
            ?>
                <div class="session" data-value="<?php echo $testText?>">
                        <div class="tag"><?php echo $test['test_name']?></div>
                        <div class="company"><?php echo $test['test_type_cde']?></div>
                        <div class="position"><?php echo $test['rm_id']?></div>
                        <div class="presenter"><?php echo $test['test_dt']?></div>
                        <div class="remaining"><img src="../images/deleteIcon.gif"
                                                    onclick="deleteCourse(<?php echo $test['test_id']; ?>);"
                                                    title="Delete Test"
                                                    style="cursor:pointer"></div>
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
