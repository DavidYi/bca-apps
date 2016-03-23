<script type="text/javascript">
    function deleteMentor(mentorID) {
        if (confirm('Are you sure you would like to delete the mentor?')) {
            window.parent.parent.location.href = 'view.php?action=delete_mentor&mentor_id=' + mentorID;
        }
    }

</script>
<head>
    <title>Admin: Mentor</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <!-- Styles -->
    <link href="../../admin/ss/main.css" rel="stylesheet">
</head>

<body>
<header>
    <h1 class="title">Mentors</h1>
</header>

<nav class="navbar">
    <a href="#">
        <div class="session-filter last_name">Last Name</div>
    </a>
    <a href="#">
        <div class="session-filter first_name">First Name</div>
    </a>
    <a href="#">
        <div class="session-filter company">Company</div>
    </a>
    <a href="#">
        <div class="session-filter position">Room</div>
    </a>
    <a href="#">
        <div class="session-filter teacher">Position</div>
    </a>
    <a href="#>">
        <div class="session-filter room">Teacher</div>
    </a>
    <a href="#">
        <div class="session-filter capacity">Max</div>
    </a>
</nav>


<?php foreach ($mentorList as $mentor) :

$mentorId = $mentor['mentor_id'];
$mentor_last_name = $mentor['mentor_last_name'];
$mentor_first_name = $mentor['mentor_first_name'];
$mentor_position = $mentor['mentor_position'];
$mentor_company = $mentor['mentor_company'];
$pres_room = $mentor['pres_room'];
$pres_host_teacher = $mentor['pres_host_teacher'];
$pres_max_capacity = $mentor['pres_max_capacity'];

?>

<div class="list-container" onclick="modify(<?php echo($mentorId) ?>);">
    <div class="mentor">

        <div class="session-filter last_name"><?php echo $mentor_last_name; ?></div>
        <div class="session-filter first_name"><?php echo $mentor_first_name; ?></div>
        <div class="session-filter company"><?php echo $mentor_company; ?></div>
        <div class="session-filter room"><?php echo $pres_room; ?></div>
        <div class="session-filter position"><?php echo $mentor_position; ?></div>
        <div class="session-filter teacher"><?php echo $pres_host_teacher; ?></div>
        <div class="session-filter capacity"><?php echo $pres_max_capacity; ?></div>

        <?php endforeach; ?>
    </div>
</div>

<div class="fab">
    <a id="fab-action" trigger="mentor-add.html"><span class="plus">+</span></a>
</div>

</body>

<script>function modify($mentorId) {
        window.parent.parent.location.href = "index.php?action=show_modify_mentor&mentor_id=" + $mentorId;
    }
</script>