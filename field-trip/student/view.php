<html>
<head>
    <title>Student Side</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <!-- Styles comment so i can push -->

    <link href="../ss/main.css<?php echo(getVersionString()); ?>" rel="stylesheet">
    <link href="../teacher/view.css<?php echo(getVersionString()); ?>" rel="stylesheet">

    <script>
        function deleteCourse(courseId)
        {
            if (confirm('Are you sure you would like to delete the course?'))
            {
                window.parent.parent.location.href = 'index.php?action=delete_course&course_id=' + courseId;
            }
        }
    </script>
</head>
<body>
<section class="main view">
    <div class="view-main">
        <div class="login-status">
            <h3><b><?php echo($user->usr_first_name . " " . $user->usr_last_name); ?></b></h3>
            <h3 class="log-out"><a href="./index.php?action=logout">
                    <?php if (isset($_SESSION['prev_usr_id'])) { ?> Return to Admin Panel <?php } else { ?> Log Out <?php } ?>
                </a></h3>
        </div>
        <div class="vertical-center">
            <?php if (!isset($_SESSION['prev_usr_id'])) { ?>

            <h1>Student Instructions</h1>
            <h3>If you wish to take an elective offered during mods 1-24, you need to do two things.  First, click "Modify Availability" to indicate all of the free mods when you can take an elective.  Don't forget to leave yourself lunch.  Lunch is required!</h3>
            <h3>Second, select all of the courses that interest you.</h3>
            <h3>Then, based upon student interests and common availability, BCA will schedule as many off-hour electives as possible.</h3>
        </div>
            <?php } else { ?>
                <h1>Mimic User Mode</h1>
            <?php } ?>
        </div>
    </div>

    <div class="view-signup enrollment">
        <div class="vertical-center">
            <h3><b>Availability</b> | <a href="index.php?action=modify_times">Modify Availability</a></h3>
            <table class="course-table" style="width:90%">
                <?php
                if (empty($time_strings)) {
                    echo "<p>None</p>";
                } else {
                    echo "
                <thead>
                    <th>Day</th>
                    <th>Mods</th>
                </thead>
            ";
                }
                ?>
                <?php foreach ($time_strings as $string) :
                    ?>

                    <tr>
                        <td><?php echo $string["day"] ?></td>
                        <td><?php echo $string["mods_available"] ?></td>
                    </tr>

                <?php endforeach; ?>
            </table>

            <br>
            <br>

            <h3><b>Courses I'm Interested In</b> | <a href="index.php?action=modify_courses">Edit</a></h3>
            <table class="course-table" style="width:90%">
                <?php
                if (empty($courses)) {
                    echo "<p>None</p>";
                } else {
                    echo "
                        <thead>
                            <th>Name</th>
                            <th>Description</th>
                            <th></th>
                        </thead>
                    ";
                }
                ?>

                <?php foreach ($courses as $course) :
                    $courseName = $course['course_name'];
                    $courseDesc = $course['course_desc'];
                    $courseID = $course['course_id'];
                    ?>

                    <tr>
                        <td><?php echo $courseName ?></td>
                        <td><?php echo $courseDesc ?></td>
                        <td><img src="../../shared/images/deleteIcon.gif" onclick="deleteCourse(<?php echo $courseID; ?>);"> </td>
                    </tr>

                <?php endforeach; ?>
            </table>
            <br>
            <br>
        </div>
    </div>
</section>
</body>
</html>