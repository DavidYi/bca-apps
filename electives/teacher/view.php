<html lang="en">
<head>
    <title><?php echo $app_title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <!-- <link rel="shortcut icon" href="images/logo.ico"> -->

    <!-- Styles -->
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link href="../ss/main.css<?php echo(getVersionString()); ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="view.css<?php echo(getVersionString()); ?>">
    <?php include_analytics(); ?>
    <style>
        th, td {
            padding: 5px;
            text-align: left;
            border-bottom: 1px solid #333333;
        }
    </style>

    <script src="../js/jquery.min.js<?php echo(getVersionString()); ?>"></script>
    <script type="text/javascript" src="../js/jquery.easing.min.js<?php echo(getVersionString()); ?>"></script>
    <script type="text/javascript" src="../js/jquery.plusanchor.min.js<?php echo(getVersionString()); ?>"></script>
    <script type="text/javascript">
        function deleteCourse(courseId)
        {
            if (confirm('Are you sure you would like to delete the course?'))
            {
                window.parent.parent.location.href = 'index.php?action=delete_course&course_id=' + courseId;
            }
        }


        $(function() {
            // ----- OPEN
            $('[data-popup-open]').on('click', function (e) {
                var header = 'Delete course ' + '<?php $courseName ?>' + '?';
                $('#popup_header').text(header);

                var targeted_popup_class = jQuery(this).attr('data-popup-open');
                $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);

                e.preventDefault();
            });

            //----- CLOSE
            $('[data-popup-close]').on('click', function (e) {
                var targeted_popup_class = jQuery(this).attr('data-popup-close');
                $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);

                e.preventDefault();
            });
        });

        $('body').plusAnchor({
            easing: 'easeInOutExpo',
            speed: 700
        });
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
            <h1>Teacher Instructions</h1>
            <h3>If you wish to offer an elective during mods 1-24, you need to do two things.  First, click "Modify Availability" to indicate <em>all</em> of the free mods when you could teach the class.  </h3>
            <h3>Second, click "Add Course" to create the class listing for students.  Then, students will indicate which electives interest them.</h3>
            <h3>Finally, based upon student interests and common availability, BCA will schedule as many off-hour electives as possible.</h3>

        </div>
        <?php } else { ?>
            <h1>Mimic User Mode</h1>
        <?php } ?>
        </div>
    </div>

    <div class="view-signup enrollment">
        
        <div class="vertical-center">
            <h3><b>Availability</b> | <a href="availability/index.php?teacher=1">Modify Availability</a></h3>
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

            <h3><b>Courses</b> | <a href="teacher_add_course/index.php">Add Course</a></h3>
            <table style="width:90%">
                <?php
                if (empty($courses)) {
                    echo "<p>None</p>";
                } else {
                    echo "
                        <thead>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Students</th>
                            <th>Actions</th>
                            <th>Status</th>
                        </thead>
                    ";
                }
                ?>

                <?php foreach ($courses as $course) :
                    $courseName = trim($course['course_name']);
                    $courseDesc = trim($course['course_desc']);
                    $numStudents = $course['num_students'];
                    $courseID = $course['course_id'];
                    $active = $course['active'];
                    ?>
                    
                    <tr>
                        <td><?php echo $courseName ?></td>
                        <td><?php echo $courseDesc ?></td>
                        <td>
                            <?php
                            if ($numStudents == 0)
                                echo ("0");
                            else
                                echo ("<a href=\"course_signup_matrix/index.php?course_id=".$courseID . "\">" . $numStudents . "</a>");
                            ?>
                        </td>

                        <td><a href="edit_course/index.php?course_name=<?php echo $courseName ?>&course_desc=<?php echo $courseDesc?>&course_id=<?php echo $courseID?>&active=<?php echo $active?>">
                                <img src="../../shared/images/modifyIcon.gif"></a>
                            &nbsp; &nbsp; &nbsp; &nbsp;
                            <img src="../../shared/images/deleteIcon.gif" onclick="deleteCourse(<?php echo $courseID; ?>);">
                        </td>
                        <td>
                            <?php if($active == 1){
                                echo("Active");
                            }
                            else {
                                echo("Inactive");
                            }?>
                        </td>
                    </tr>

                <?php endforeach; ?>
            </table>
            <br>
            <br>
        </div>
    </div>
</section>

<div id="popup" class="popup" data-popup="popup-1">
    <div class="popup-inner">
        <h2 id="popup_header">Delete Course?</h2>
        <p><a data-popup-close="popup-1" href="#">Cancel</a></p>
        <a class="popup-close" data-popup-close="popup-1" href="#">x</a>
    </div>
</div>


</body>
</html>