<html lang="en">
<head>
    <title><?php echo $app_title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <!-- <link rel="shortcut icon" href="images/logo.ico"> -->

    <!-- Styles -->
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link href="../ss/main.css" rel="stylesheet">
    <?php include_analytics(); ?>
    <style>
        th, td {
            padding: 5px;
            text-align: left;
            border-bottom: 1px solid #333333;
        }
    </style>
</head>
<body>

<section class="main view">
    <div class="view-main">
        <div class="login-status">
            <h3><b><?php echo($user->usr_first_name . " " . $user->usr_last_name); ?></b></h3>
            <h3 class="log-out"><a href="./index.php?action=logout">Log Out</a></h3>
        </div>
        <div class="vertical-center">
            Teacher Page!
            <br>
            <br>
            Instructions here.
        </div>
    </div>
    <div class="view-signup enrollment">
        <div class="vertical-center">
            <h3><b>Availability</b></h3>
            Show availability table here
            <p><?php echo($timesString);?></p>
        <a href="index.php?action=modify_times">Modify Availability</a>
        </div>
        <br>
        <br>
        <br>
        <div class="vertical-center">
            <h3><b>Courses</b> | <a href="teacher_add_course/index.php">Add Class</a></h3>

            <table style="width:75%">
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                </tr>
                <?php foreach ($courses as $course) :
                    $courseName = $course['course_name'];
                    $courseDesc = $course['course_desc'];
                    $courseID = $course['course_id'];
                    ?>


                    <tr>
                        <td><?php echo $courseName ?></td>
                        <td><?php echo $courseDesc ?></td>
                        <td><a href="edit_course/index.php?course_name=<?php echo $courseName ?>&course_desc=<?php echo $courseDesc?>&course_id=<?php echo $courseID?>">Edit</a></td>
                    </tr>

                <?php endforeach; ?>
            </table>
        </div>
    </div>
</section>


<script type="text/javascript" src="../js/jquery.easing.min.js"></script>
<script type="text/javascript" src="../js/jquery.plusanchor.min.js"></script>
<script type="text/javascript">
    $('body').plusAnchor({
        easing: 'easeInOutExpo',
        speed: 700
    });
</script>
</body>
</html>