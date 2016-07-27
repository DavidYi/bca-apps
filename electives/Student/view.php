<html>
<head>
    <title>Student Side</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <!-- Styles comment so i can push -->

    <link href="../ss/main.css" rel="stylesheet">
    <link href="../teacher/view.css" rel="stylesheet">

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
            <h3 class="log-out"><a href="./index.php?action=logout">Log Out</a></h3>
        </div>

        <div class="vertical-center">
            Student Page!
            <br>
            <br>
            Instructions here.
        </div>
    </div>

    <div class="view-signup enrollment">
        <div class="vertical-center">
            <h3><b>Availability</b> | <a href="index.php?action=modify_times">Modify Availability</a></h3>
            <table style="width:90%">
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
                        <td><?php echo "<p>" . $string["day"] ?></td>
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
        </div>
    </div>
</section>
</body>
</html>