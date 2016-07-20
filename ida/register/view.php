<html lang="en">
<head>
    <title>IDA Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <!-- <link rel="shortcut icon" href="images/logo.ico"> -->

    <!-- Styles -->
    <link href="../../shared/ss/main.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <?php include_analytics(); ?>
</head>
<body>
<section class="main">
    <header>
        <h1 class="title main-title">Register for IDA</h1>
    </header>

    <nav class="navbar">
        <a href="index.php?session=<?php echo $currentSession ?>&action=<?php echo $action ?>&sort=1&order=<?php if ($sort_order == 1 && $sort_by == 1) { echo 2; } else { echo 1; } ?>"><div class="session-filter tag">Title</div></a>
        <a href="index.php?session=<?php echo $currentSession ?>&action=<?php echo $action ?>&sort=2&order=<?php if ($sort_order == 1 && $sort_by == 2) { echo 2; } else { echo 1; } ?>"><div class="session-filter presenter">Presenters</div></a>
        <a href="index.php?session=<?php echo $currentSession ?>&action=<?php echo $action ?>&sort=3&order=<?php if ($sort_order == 1 && $sort_by == 3) { echo 2; } else { echo 1; } ?>"><div class="session-filter position">Format</div></a>
        <a href="index.php?session=<?php echo $currentSession ?>&action=<?php echo $action ?>&sort=&order=<?php if ($sort_order == 1 && $sort_by == 4) { echo 2; } else { echo 1; } ?>"><div class="session-filter remaining">Remaining</div></a>
    </nav>

    <div class="enrollment">
        <!-- here -->
        <?php if ($is_changing) {
            $presentation = get_sessions_by_user($user->usr_id)[$currentSession - 1];
            $id = $presentation['pres_id'] ?>
            <a class="default-link" style="position: absolute; width: 100%; height: 100%; z-index: 1;" href="/<?php echo $app_url_path ?>/itinerary"></a>
                <div class="session session-selected">
                    <div class="tag"><?php echo $presentation['wkshp_nme']?></div>
                    <div class="presenter">
                        <a class="info" style="float: left; position: relative; z-index: 9" onclick="popup('#B<?php echo $id?>, #P<?php echo $id?>')">
                            &#x271A;&#xa0;
                        </a>
                        <?php echo $presentation['presenter_names']?>
                    </div>

                    <div class="position"><?php echo $presentation['format_name']?></div>
                    <div class="remaining"><?php echo ($presentation['pres_max_seats'] - $presentation['pres_enrolled_seats'])?></div>
                </div>

                <div class="popup-bg" id="B<?php echo $presentation['pres_id']?>" style="display: none;
opacity: 0.7;
background: #000;
width: 100%;
height: 100%;
z-index: 10;
top: 0;
left: 0;
position: fixed;">
                </div>

                <div class="popup" id="P<?php echo $id?>">
                    <div class="entpop">
                        <div class="close">
                            <div class="presname"><?php echo $presentation['wkshp_nme']?></div>
                            <div class="x"><a href="#" style="color:#f0c30f" onclick="cpopup('#B<?php echo $id?>,#P<?php echo $id?>')">&#x2716;</a></div>
                        </div>
                        <div class="popup-c">
                            <h3><?php echo $presentation['presenter_names']?>, <?php echo $presentation['org_name'];?></h3>
                            <p><?php echo $presentation['wkshp_desc'];?></p>
                        </div>
                    </div>
                </div>
        <?php } ?>
    <?php foreach ($presentations as $presentation) {
        if ($id != $presentation['pres_id']) {?>
            <div class="main-panel" style="position: relative;">
                <a class="default-link" style="position: absolute; width: 100%; height: 100%; z-index: 1;" href="index.php?session=<?php echo $currentSession?>&action=commit&pres_id=<?php echo $presentation['pres_id']?>"></a>
                <div class="session" style="position: relative;">
                    <div class="tag"><?php echo $presentation['wkshp_nme']?>&nbsp;</div>
                    <div class="presenter"><a class="info" style="float: left; position: relative; z-index: 9; color: #555555;" onclick="popup('#B<?php echo $presentation['pres_id']?>,#P<?php echo $presentation['pres_id']?>')">&#x271A;&#xa0;&nbsp;</a><?php echo $presentation['presenter_names']?></div>
                    <div class="position"><?php echo $presentation['format_name']?>&nbsp;</div>
                    <div class="remaining"><?php echo ($presentation['pres_max_seats'] - $presentation['pres_enrolled_seats'])?></div>
                </div>

                <div class="popup-bg" id="B<?php echo $presentation['pres_id']?>" style="display: none;
opacity: 0.7;
background: #000;
width: 100%;
height: 100%;
z-index: 10;
top: 0;
left: 0;
position: fixed;">
                </div>

                <div class="popup" id="P<?php echo $presentation['pres_id']?>">
                    <div class="entpop">
                        <div class="close">
                            <div class="presname"><?php echo $presentation['wkshp_nme']?></div>
                            <div class="x"><a href="#" style="color:#f0c30f" onclick="cpopup('#B<?php echo $presentation['pres_id']?>,#P<?php echo $presentation['pres_id']?>')">&#x2716;</a></div>
                        </div>
                        <div class="popup-c">
                            <h3><?php echo $presentation['presenter_names']?>, <?php echo $presentation['org_name'];?></h3>
                            <p><?php echo $presentation['wkshp_desc'];?></p>
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
