<!DOCTYPE html>
<html lang="en">
<script type="text/javascript">
    function deleteMentor(mentorID) {
        if (confirm('Are you sure you would like to delete the presentation?')) {
            window.parent.parent.location.href = 'view.php?action=delete_mentor&mentor_id=' + mentorID;
        }
    }

</script>
<head>
    <title>Admin: Presentation</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <!-- Styles -->
    <link href="../../admin/ss/main.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
</head>

<body>
<header>
    <h1 class="title">Presentation</h1>
</header>
<div style="text-align:center;padding-bottom:2vh;">
    <a href="./index.php?workshop_id=<?php echo $workshop_id ?>&action=show_add_workshop"><button>Add Workshop</button></a>
    <a href="../index.php"><button>Return Home</button></a>
</div>
<nav class="navbar">
    <a href="#">
        <div class="session-filter name">Workshop</div>
    </a>
    <a href="#">
        <div class="session-filter company">Presenters</div>
    </a>
    <a href="#">
        <div class="session-filter name">Organization</div>
    </a>
    <a href="#>">
        <div class="session-filter capacity">Session</div>
    </a>
    <a href="#>">
        <div class="session-filter capacity">Room</div>
    </a>
    <a href="#">
        <div class="session-filter capacity">Seats</div>
    </a>
    <a href="#">
        <div class="session-filter capacity">Enrolled</div>
    </a>
</nav>


<div class="list-container">

    <?php foreach ($presentationList as $presentation) {
        $pres_id = $presentation['pres_id'];
        $wkshp_id = $presentation['wkshp_id'];
        $presenter_names = $presentation['presenter_names'];
        $org_name = $presentation['org_name'];
        $rm_id = $presentation['rm_id'];
        $pres_max_seats = $presentation['pres_max_seats'];
        $pres_enrolled_seats = $presentation['pres_enrolled_seats'];

        ?>
        <a href="./index.php?pres_id=<?php echo $pres_id ?>&action=show_modify_presentation">
            <div class="mentor" id="workshop">
                <div class="session-filter name"><?php echo(get_workshop($wkshp_id)); ?></div>
                <div class="session-filter company"><?php echo $presenter_names; ?></div>
                <div class="session-filter name"><?php echo $org_name; ?></div>
                <div class="session-filter capacity"><?php echo $ses_id; ?></div>
                <div class="session-filter capacity"><?php echo ((get_room($rm_id)['rm_nbr'])); ?></div>
                <div class="session-filter capacity"><?php echo $pres_max_seats; ?></div>
                <div class="session-filter capacity"><?php echo $pres_enrolled_seats; ?></div>
            </div>
        </a>

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
