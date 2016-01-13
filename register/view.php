<html lang="en">
<head>
    <title>Career Day Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <!-- <link rel="shortcut icon" href="images/logo.ico"> -->

    <!-- Styles -->
    <link href="/<?php echo $app_name ?>/ss/main.css" rel="stylesheet">
    <?php include_analytics(); ?>
</head>
<body>
<section class="main">
    <header>
        <h1 class="title main-title">Register for Career Day</h1>
    </header>

    <nav class="navbar">
        <a href="index.php?session=<?php echo $currentSession ?>&action=<?php echo $action ?>&sort=1"><div class="session-filter tag">Field</div></a>
        <a href="index.php?session=<?php echo $currentSession ?>&action=<?php echo $action ?>&sort=2"><div class="session-filter title">Position</div></a>
        <a href="index.php?session=<?php echo $currentSession ?>&action=<?php echo $action ?>&sort=3"><div class="session-filter presenter">Presenter</div></a>
        <a href="index.php?session=<?php echo $currentSession ?>&action=<?php echo $action ?>&sort=4"><div class="session-filter company">Company</div></a>
        <a href="index.php?session=<?php echo $currentSession ?>&action=<?php echo $action ?>&sort=5"><div class="session-filter remaining">Remaining</div></a>
    </nav>

    <div class="enrollment">
        <?php if ($is_changing) {
            $presentation = get_sessions_by_user($user['usr_id'])[$currentSession - 1];
            $id = $presentation['pres_id'] ?>
            <a href="/<?php echo $app_name ?>/itinerary">

            <div class="session session-selected"">
                <div class="tag"><?php echo $presentation['mentor_field']?></div>
                <div class="title"><?php echo $presentation['mentor_position']?></div>
                <div class="presenter">
                    <?php echo $presentation['mentor_last_name'] ?>,
                    <?php echo $presentation['mentor_first_name'] ?>
                </div>
                <div class="company"><?php echo $presentation['mentor_company']?></div>
                <div class="remaining">
                    <?php echo ($presentation['pres_max_capacity'] - $presentation['pres_enrolled_count'])?>
                </div>
            </div>
            </a>
        <?php } ?>
        <?php foreach ($presentations as $presentation) {
            if ($id != $presentation['pres_id']) {?>
               <a href="index.php?session=<?php echo $currentSession?>&action=commit&pres_id=<?php echo $presentation['pres_id']?>"> <div class="session">
                    <div class="tag"><?php echo $presentation['mentor_field']?></div>
                    <div class="title"><?php echo $presentation['mentor_position']?></div>
                    <div class="presenter">
                        <?php echo $presentation['mentor_last_name'] ?>,
                        <?php echo $presentation['mentor_first_name'] ?>
                    </div>
                    <div class="company"><?php echo $presentation['mentor_company']?></div>
                    <div class="remaining">
                        <?php echo ($presentation['pres_max_capacity'] - $presentation['pres_enrolled_count'])?>
                    </div>
                </div> </a>
        <?php } } ?>

        <div class="session"></div> <!-- fill design -->
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