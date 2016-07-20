<html>
<head>
    <title>Student Side</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <!-- Styles comment so i can push -->

    <link href="../ss/main.css" rel="stylesheet">

</head>
<body>
<section class="main view">
    <div class="view-main">
        <main>
            <div class="login-status">
                <h3><b><?php echo($user->usr_first_name . " " . $user->usr_last_name); ?></b></h3>
                <h3 class="log-out"><a href="./index.php?action=logout">Log Out</a></h3>
            </div>

            <h2 class="title">Student Side</h2>
            <p> Instructions </p>

        </main>
    </div>

    <div class="view-signup enrollment">
        <div class="vertical-center">
            <main>
                <div class="feature">
                    <h3><b>Availability</b> | <a href="index.php?action=modify_times">Modify Availability</a></h3>
                    <?php
                    if (empty($time_strings)) {
                        echo "<p>None</p>";
                    } else {
                        foreach ($time_strings as $string) {
                            echo "<p>" . $string["day"] . ": " . $string["mods_available"];
                        }
                    }
                    ?>
                </div>
                <div class="feature">
                    <h3><b>Courses I'm Interested In</b> | <a href="index.php?action=modify_courses">Edit</a></h3>
                    <table class="course-table" style="width:75%">
                        <?php
                        if (empty($courses)) {
                            echo "<p>None</p>";
                        } else {
                            echo "
                                <thead>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th></th>
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

                                <!-- include all course information for when the course is edited -->
                                <td><a href="edit_course/index.php?course_name=
                                    <?php echo $courseName ?>&course_desc=<?php echo $courseDesc?>
                                    &course_id=<?php echo $courseID?>"><img src="../../shared/images/modifyIcon.gif"></a></td>

                                <td><img src="../../shared/images/deleteIcon.gif" onclick="deleteCourse(<?php echo $courseID; ?>);"> </td>
                            </tr>

                        <?php endforeach; ?>
                    </table>

                </div>
            </main>
        </div>
    </div>
</section>
</body>
</html>