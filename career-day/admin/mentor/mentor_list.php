<!DOCTYPE html>
<html lang="en">
<script type="text/javascript">
    function deleteMentor(mentorID) {
        if (confirm('Are you sure you would like to delete the mentor?')) {
            window.parent.parent.location.href = 'index.php?action=delete_mentor&mentor_id=' + mentorID;
        }
    }

</script>
<head>
    <title>Admin: Mentor</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <!-- Styles -->
    <link href="../../../shared/ss/main.css" rel="stylesheet" type="text/css" />
    <link href="mentor_list.css" rel="stylesheet">
</head>

<body>
<header>
    <h1 class="title">Mentors</h1>
</header>

<nav class="navbar">
    <a href="#">
        <div class="session-filter name">Name</div>
    </a>
    <a href="#">
        <div class="session-filter company">Company</div>
    </a>
    <a href="#">
        <div class="session-filter position">Position</div>
    </a>
    <a href="#">
        <div class="session-filter teacher">Teacher</div>
    </a>
    <a href="#">
        <div class="session-filter sessions">Sessions</div>
    </a>
    <a href="#">
        <div class="session-filter room">Room</div>
    </a>
    <a href="#">
        <div class="session-filter capacity">Max</div>
    </a>
    <a href="#">
        <div class="session-filter delete"></div>
    </a>
</nav>


<div class="list-container" style="max-width:90em;width:100%;">

    <?php foreach ($mentorList as $mentor) :

        $mentor_id = $mentor['mentor_id'];
        $mentor_last_name = $mentor['mentor_last_name'];
        $mentor_first_name = $mentor['mentor_first_name'];
        $mentor_position = $mentor['mentor_position'];
        $mentor_company = $mentor['mentor_company'];
        $pres_room = $mentor['pres_room'];
        $pres_host_teacher = $mentor['pres_host_teacher'];
        $pres_max_capacity = $mentor['pres_max_capacity'];
        $sessions = $mentor['sessions'];

    ?>
        <div class="mentor" onclick="javascript:location.href='./index.php?mentor_id=<?php echo $mentor_id ?>&action=show_modify_mentor'">
            <div class="session-filter name">&nbsp<?php echo($mentor_last_name . ', ' . $mentor_first_name); ?></div>
            <div class="session-filter company">&nbsp<?php echo $mentor_company; ?></div>
            <div class="session-filter position">&nbsp<?php echo $mentor_position; ?></div>
            <div class="session-filter teacher">&nbsp<?php echo $pres_host_teacher; ?></div>
            <div class="session-filter sessions">&nbsp<?php echo $sessions; ?></div>
            <div class="session-filter room">&nbsp<?php echo $pres_room; ?></div>
            <div class="session-filter capacity">&nbsp<?php echo $pres_max_capacity; ?></div>
            <div class="session-filter delete"><img src="../../../shared/images/deleteIcon.gif" id="<?php echo $mentor_id ?>"/></div>
        </div>


     <?php endforeach; ?>
</div>


<div class="fab">
    <a id="fab-action" trigger="./index.php?mentor_id=<?php echo $mentor_id?>&action=show_add_mentor"><span class="plus">+</span></a>
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
    });

    $('img').click(function(){
        var id = $(this).attr('id');
        deleteMentor(id);
    });

</script>
</body>
</html>
