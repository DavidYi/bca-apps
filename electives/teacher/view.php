<html lang="en">
<head>
    <title><?php echo $app_title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <!-- <link rel="shortcut icon" href="images/logo.ico"> -->

    <!-- Styles -->
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link href="../ss/main.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="view.css">
    <?php include_analytics(); ?>
    <style>
        th, td {
            padding: 5px;
            text-align: left;
            border-bottom: 1px solid #333333;
        }
    </style>

    <script src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/jquery.easing.min.js"></script>
    <script type="text/javascript" src="../js/jquery.plusanchor.min.js"></script>
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

        $(document).ready(function()  {
            var action = <?php echo $action ?>;
            var animate = 0;
            if (animate == 0) {

                var header = 'Delete course ' + '<?php $courseName ?>' + '?';
                $('#popup_header').text(header);

                $('#popup').fadeIn(350);
            }



            var targeted_popup_class = jQuery(this).attr('data-popup-open');
            $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);

            e.preventDefault();
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
<!--                        <td><a href="index.php?action=delete&course_name=--><?php //echo $courseName ?><!--&course_id=--><?php //echo $courseID ?><!--" class="btn" data-popup-open="popup-1" >Delete</a></td>-->
                        <td><img src="../../shared/images/deleteIcon.gif" onclick="deleteCourse(<?php echo $courseID; ?>);"> </td>
                    </tr>

                <?php endforeach; ?>
            </table>
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