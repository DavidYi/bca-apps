<!DOCTYPE html>
<html lang="en">
<script type="text/javascript">
    function deletePresentation(presID) {
        if (confirm('Are you sure you would like to delete the presentation?')) {
            window.parent.parent.location.href = 'index.php?action=delete_presentation&pres_id=' + presID;
        }
    }

</script>
<head>
    <title>Admin: Presentation</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <!-- Styles -->
    <link href="../../../shared/ss/main.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
</head>

<body>
<header>
    <h1 class="title">Presentation</h1>
</header>
<div style="text-align:center;padding-bottom:2vh;">
    <a href="./index.php?pres_id=<?php echo $pres_id ?>&action=show_add_presentation"><button id="add_pres">Add Presentation</button></a>
    <a href="../index.php"><button id="return_home">Return Home</button></a>
</div>
<nav class="navbar" style="">
    <a href="#">
        <div class="session-filter organization">Workshop</div>
    </a>
    <a href="#">
        <div class="session-filter organization">Presenters</div>
    </a>
    <a href="#">
        <div class="session-filter organization">Organization</div>
    </a>
    <a href="#>">
        <div class="session-filter smallcol">Session</div>
    </a>
    <a href="#>">
        <div class="session-filter smallcol">Room</div>
    </a>
    <a href="#">
        <div class="session-filter smallcol">Seats</div>
    </a>
    <a href="#">
        <div class="session-filter smallcol">Enrolled</div>
    </a>
    <a href="#">
        <div class="session-filter smallcol"></div>
    </a>
</nav>


<div class="list-container" style="">

    <?php foreach ($presentationList as $presentation) {
        $pres_id = $presentation['pres_id'];
        $wkshp_id = $presentation['wkshp_id'];
        $presenter_names = $presentation['presenter_names'];
        $org_name = $presentation['org_name'];
        $rm_id = $presentation['rm_id'];
        $rm_nbr = $presentation['rm_nbr'];
        $wkshp_nme = $presentation['wkshp_nme'];
        $pres_max_seats = $presentation['pres_max_seats'];
        $pres_enrolled_seats = $presentation['pres_enrolled_seats'];
        $ses_id = $presentation['ses_id'];

        ?>
            <div class="mentor row" id="workshop">
                <a href="./index.php?pres_id=<?php echo $pres_id ?>&action=show_modify_presentation">
                <div class="session-filter organization"><h2><?php echo($wkshp_nme); ?></h2></div>
                <div class="session-filter organization"><h2><?php echo $presenter_names; ?></h2></div>
                <div class="session-filter organization"><h2><?php echo $org_name; ?></h2></div>
                <div class="session-filter smallcol"><h2><?php echo $ses_id; ?></h2></div>
                <div class="session-filter smallcol"><h2><?php if($rm_nbr == null) {echo("Null");} else {echo($rm_nbr);} ?></h2></div>
                <div class="session-filter smallcol"><h2><?php echo $pres_max_seats; ?></h2></div>
                <div class="session-filter smallcol"><h2><?php echo $pres_enrolled_seats; ?></h2></div>
                </a>
                <h4 class="del_icon" onclick="deletePresentation(<?php echo $pres_id; ?>);">d</h4>
            </div>

    <?php } ?>
</div>

<script type="text/javascript" src="../../admin/js/jquery.min.js"></script>
<script type="text/javascript" src="../../admin/js/jquery.easing.min.js"></script>
<script type="text/javascript" src="../../admin/js/jquery.plusanchor.min.js"></script>
<script type="text/javascript" src="../../admin/js/featherlight.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('body').plusAnchor({
            easing: 'easeInOutExpo',
            speed: 700
        });
    });

    $('#fab-action').click(function () {
        $.featherlight($('<iframe width="1000" height="800" src="' + $(this).attr('trigger') + '"/>'))
    })

</script>
</body>
</html>
