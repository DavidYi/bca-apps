<html lang="en">
<head>
    <title>Career Day Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <!-- <link rel="shortcut icon" href="images/logo.ico"> -->

    <!-- Styles -->
    <link href="/<?php echo $app_url_path ?>/ss/main.css" rel="stylesheet">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <?php include_analytics(); ?>
</head>
<body>
<section class="main">
    <header>
        <h1 class="title main-title">Register for Career Day</h1>
    </header>

    <nav class="navbar">
        <a href="index.php?session=<?php echo $currentSession ?>&action=<?php echo $action ?>&sort=1&order=<?php if ($sort_order == 1 && $sort_by == 1) { echo 2; } else { echo 1; } ?>"><div class="session-filter tag">Field</div></a>
        <a href="index.php?session=<?php echo $currentSession ?>&action=<?php echo $action ?>&sort=4&order=<?php if ($sort_order == 1 && $sort_by == 4) { echo 2; } else { echo 1; } ?>"><div class="session-filter company">Company</div></a>
        <a href="index.php?session=<?php echo $currentSession ?>&action=<?php echo $action ?>&sort=2&order=<?php if ($sort_order == 1 && $sort_by == 2) { echo 2; } else { echo 1; } ?>"><div class="session-filter position">Position</div></a>
        <a href="index.php?session=<?php echo $currentSession ?>&action=<?php echo $action ?>&sort=3&order=<?php if ($sort_order == 1 && $sort_by == 3) { echo 2; } else { echo 1; } ?>"><div class="session-filter presenter">Presenter</div></a>
        <a href="index.php?session=<?php echo $currentSession ?>&action=<?php echo $action ?>&sort=5&order=<?php if ($sort_order == 1 && $sort_by == 5) { echo 2; } else { echo 1; } ?>"><div class="session-filter remaining">Remaining</div></a>
    </nav>

    <div class="enrollment">
        <!-- here -->
        <?php if ($is_changing) {
            $presentation = get_sessions_by_user($user->usr_id)[$currentSession - 1];
            $id = $presentation['pres_id'] ?>
            <a href="/<?php echo $app_url_path ?>/itinerary">

                <div class="session session-selected">
                    <div class="tag"><?php echo $presentation['mentor_field']?></div>
                    <div class="company"><?php echo $presentation['mentor_company']?></div>
                    <div class="position"><?php echo $presentation['mentor_position']?></div>
                    <div class="presenter"><div class="info" style="position: relative; float: left; z-index: 99;">&#x271A;&#xa0;</div><?php echo ($presentation['mentor_last_name'].", ".$presentation['mentor_first_name'])?></div>
                    <div class="remaining"><?php echo ($presentation['pres_max_capacity'] - $presentation['pres_enrolled_count'])?></div>
                </div>
            </a>
        <?php } ?>
        <?php foreach ($presentations as $presentation) {
            if ($id != $presentation['pres_id']) {?>
                <div class="main-panel" style="position: relative;">
                    <a class="default-link" style="position: absolute; width: 100%; height: 100%; z-index: 1;" href="index.php?session=<?php echo $currentSession?>&action=commit&pres_id=<?php echo $presentation['pres_id']?>"></a>
                    <div class="session" style="position: relative;">
                        <div class="tag"><?php echo $presentation['mentor_field']?>&nbsp;</div>
                        <div class="company"><?php echo $presentation['mentor_company']?>&nbsp;</div>
                        <div class="position"><?php echo $presentation['mentor_position']?>&nbsp;</div>
                        <div class="presenter"><a class="info" style="float: left; position: relative; z-index: 100; color: #555555;" onclick="popup()">&#x271A;&#xa0;&nbsp;</a><?php echo ($presentation['mentor_last_name'].", ".$presentation['mentor_first_name'])?></div>
                        <div class="remaining"><?php echo ($presentation['pres_max_capacity'] - $presentation['pres_enrolled_count'])?></div>
                    </div>

                    <div class="popup-bg" style="display: none;
  opacity: 0.7;
  background: #000;
  width: 100%;
  height: 100%;
  z-index: 10;
  top: 0;
  left: 0;
  position: fixed;">
                    </div>

                    <div class="popup">
                        <div class="entpop">
                            <div class="close">
                                <div class="presname"><?php echo ($presentation['mentor_last_name'].", ".$presentation['mentor_first_name'])?></div>
                                <div class="x""><a href="#" style="color:#f0c30f" onclick="cpopup()">&#x2716;</a></div>
                        </div>
                        <div class="popup-c">
                            <p>
                                <?php echo ($presentation['mentor_last_name'].", ".$presentation['mentor_first_name'])?>, Lorem ipsum dolor sit amet, perfecto senserit argumentum ut vim, in debet appareat vis. Et dicta neglegentur vel, legere corrumpit ad qui. Cum solum solet civibus cu. Postea assentior vim eu. At vis modo semper. Nec ut omittam albucius intellegam, partem quidam ad nec. Id error graecis eum, oporteat prodesset ut duo.

                                Tempor mnesarchum vix ea. Quo alienum inimicus ex. His meliore corpora no, ex homero convenire definiebas quo. Ut usu affert quidam hendrerit, dicta essent democritum vix at. Te sed solet apeirian, qui ex idque paulo.

                                His numquam invidunt petentium et, eu est inani civibus complectitur. Timeam ceteros vix eu, est at case principes, an omnes minimum qui. Duo te nominati repudiandae, mel facer dolorum ne. Cu euripidis argumentum eam, delenit eligendi interpretaris usu et.

                                Qui ut audire ponderum interesset. Movet hendrerit reformidans eos an, mel soluta deleniti te, vis cu neglegentur philosophia. His habemus forensibus ullamcorper cu, has ad oblique adipisci. Ex iriure utamur patrioque has, sed prima falli eu, ne mea alii albucius. Sale euripidis ex quo, detraxit indoctum voluptatum eam eu. Qui ex homero audire legimus, has ne iuvaret facilisis efficiantur.                </p>
                        </div>
                    </div>
                </div>

                </div>
            <?php } } ?>
    </div>
</section>

<script type="text/javascript" src="../js/popup.js"></script>
<script type="text/javascript" src="../js/cpopup.js"></script>
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
