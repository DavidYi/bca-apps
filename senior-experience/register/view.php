<?php
/**
 * Created by PhpStorm.
 * User: David
 * Date: 2/24/2016
 * Time: 10:06 AM
 */
?>

<html lang="en">
<head>
    <title>Senior Experience Registration</title>
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
        <h1 class="title main-title">Register for Senior Experience</h1>
    </header>

    <nav class="navbar">
        <a href="index.php?session=<?php echo $currentSession ?>&action=<?php echo $action ?>&sort=1&order=<?php if ($sort_order == 1 && $sort_by == 1) { echo 2; } else { echo 1; } ?>"><div class="session-filter tag">Field</div></a>
        <a href="index.php?session=<?php echo $currentSession ?>&action=<?php echo $action ?>&sort=2&order=<?php if ($sort_order == 1 && $sort_by == 2) { echo 2; } else { echo 1; } ?>"><div class="session-filter position">Organization</div></a>
        <a href="index.php?session=<?php echo $currentSession ?>&action=<?php echo $action ?>&sort=3&order=<?php if ($sort_order == 1 && $sort_by == 3) { echo 2; } else { echo 1; } ?>"><div class="session-filter presenter">Presenters</div></a>
        <a href="index.php?session=<?php echo $currentSession ?>&action=<?php echo $action ?>&sort=5&order=<?php if ($sort_order == 1 && $sort_by == 5) { echo 2; } else { echo 1; } ?>"><div class="session-filter remaining">Remaining</div></a>
    </nav>

    <div class="enrollment">
        <!-- here -->
        <?php if ($is_changing) {
            $presentation = get_sessions_by_user($user->usr_id)[$currentSession - 1];
            $id = $presentation['pres_id'] ?>
            <a href="/<?php echo $app_url_path ?>/itinerary">

                <div class="session session-selected">
                    <div class="tag"><?php echo $presentation['field_name']?></div>
                    <div class="position"><?php echo $presentation['organization']?></div>
                    <div class="presenter"><?php echo ($presentation['presenter_names'])?></div>
                    <div class="remaining"><?php echo ($presentation['pres_max_students'] - $presentation['pres_enrolled_students'])?></div>
                </div>
            </a>
        <?php } ?>
        <?php foreach ($presentations as $presentation) {
            if ($id != $presentation['pres_id']) {?>
                <a href="index.php?session=<?php echo $currentSession?>&action=commit&pres_id=<?php echo $presentation['pres_id']?>"> 
                    <div class="session">
                        <div class="tag"><?php echo $presentation['field_name']?>&nbsp</div>
                        <div class="position"><?php echo $presentation['organization']?>&nbsp</div>
                        <div class="presenter"><?php echo ($presentation['presenter_names'])?>&nbsp</div>
                        <div class="remaining"><?php echo ($presentation['pres_max_students'] - $presentation['pres_enrolled_students'])?></div>
                    </div> </a>
            <?php } } ?>
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

