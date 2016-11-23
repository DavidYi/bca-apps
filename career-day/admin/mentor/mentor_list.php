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
    <link href="../../../shared/ss/main.css" rel="stylesheet" type="text/css"/>
    <link href="mentor_list.css" rel="stylesheet">
</head>

<body>
<header>
    <h1 class="title">Mentors</h1>
    <div class="centerit"><a href="../index.php"><button id="return_home">Back</button></a></div>
</header>

<nav class="navbar">
    <div class="session-filter column name">Name</div>
    <div class="session-filter column company">Company</div>
    <div class="session-filter column position">Position</div>
    <div class="session-filter column teacher">Teacher</div>
    <div class="session-filter column sessions">Sessions</div>
    <div class="session-filter column room">Room</div>
    <div class="session-filter column capacity">Max</div>
    <div class="session-filter delete"></div>
</nav>


<div class="list-container">

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
        <div class="mentor"
             onclick="javascript:location.href='./index.php?mentor_id=<?php echo $mentor_id ?>&action=show_modify_mentor'">
            <div class="session-filter column name">
                &nbsp<?php echo($mentor_last_name . ', ' . $mentor_first_name); ?></div>
            <div class="session-filter column company">&nbsp<?php echo $mentor_company; ?></div>
            <div class="session-filter column position">&nbsp<?php echo $mentor_position; ?></div>
            <div class="session-filter column teacher">&nbsp<?php echo $pres_host_teacher; ?></div>
            <div class="session-filter column sessions">&nbsp<?php echo $sessions; ?></div>
            <div class="session-filter column room">&nbsp<?php echo $pres_room; ?></div>
            <div class="session-filter column capacity">&nbsp<?php echo $pres_max_capacity; ?></div>
            <div class="session-filter delete"><h4 class="del_icon" onclick="deleteWorkshop(<?php echo $mentor_id ?>);">d</h4></div>
        </div>


    <?php endforeach; ?>
</div>


<div class="fab">
    <a id="fab-action" trigger="./index.php?mentor_id=<?php echo $mentor_id ?>&action=show_add_mentor"><span
            class="plus">+</span></a>
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

    $('img').click(function () {
        var id = $(this).attr('id');
        deleteMentor(id);
    });

</script>
</body>
</html>
