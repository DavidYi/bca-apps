<html>
    <head>
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="view.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <script type="text/javascript" src="../../js/jquery.min.js"></script>
        <script type="text/javascript" src="../../js/jquery.easing.min.js"></script>
        <script type="text/javascript" src="../../js/jquery.plusanchor.min.js"></script>
        <script>
            function deleteCourse(courseId)
            {
                if (confirm('Are you sure you would like to delete the course?'))
                {
                    window.parent.parent.location.href = 'index.php?action=delete_course&course_id=' + courseId;
                }
            }
        </script>
        <style>
        </style>
    </head>
    <body>
        <div class="main">
            <header>
                <h1 class="title">Elective List</h1>
                <button onclick="location.href='add/index.php'" id="add_button">Add Elective</button>
                <button onclick="location.href='../index.php'" type="submit" id="back_button">Back</button>
            </header>

            <nav id="navbar" class="navbar">
                <a href="index.php?action=sort_electives&sort=1&order=<?php if ($sort_order == 1 && $sort_by == 1) { echo 2; } else { echo 1; } ?>">
                    <div class="session-filter" style="width:12.5%;">Teacher</div>
                </a>
                <a href="index.php?action=sort_electives&sort=2&order=<?php if
                ($sort_order == 1 && $sort_by == 2) { echo 2; } else { echo 1; } ?>">
                    <div class="session-filter" style="width:14.75%;">Course Name</div>
                </a>
                <a>
                    <div class="session-filter" style="width:52.5%;">Description</div>
                </a>
                <a href="index.php?action=sort_electives&sort=3&order=<?php if
                ($sort_order == 2 && $sort_by == 3) { echo 1; } else { echo 2; } ?>">
                    <div class="center-text session-filter" style="width:8%;">
                        <p>Number of Students</p>
                    </div>
                </a>
                <a>
                    <div class="session-filter" style="width:5%;text-align:left">Edit</div>
                </a>
                <a>
                    <div class="session-filter" style="width:5%;text-align:left">Delete</div>
                </a>
            </nav>

            <div class="enrollment">
                <?php foreach($elective_list as $elective) :
                    $teacher_name = $elective['teacher_name'];
                    $course_name = $elective['course_name'];
                    $course_desc = $elective['course_desc'];
                    $num_students = $elective['num_students'];
                    $course_id = $elective['course_id'];
                    ?>

                    <div class="main-panel session">

                        <div class="cell teacher-name"><?php echo $teacher_name; ?></div>
                        <div class="cell course-name"><?php echo $course_name; ?></div>
                    <div class="cell course-desc center-text"><p id="course-desc-p"><?php echo $course_desc; ?></p></div>
                        <div class="cell num-students"><?php echo $num_students; ?></div>
                    <div class="cell edit"><span class='helper'></span>
                        <img class='icon' src="../../../shared/images/modifyIcon.gif" onclick="location.href='./index.php?action=edit&course_id=<?php echo $course_id; ?>'">
                    </div>
                    <div class="cell delete"><span class='helper'></span>
                        <img class='icon' src="../../../shared/images/deleteIcon.gif" onclick="deleteCourse(<?php echo $course_id ?>)">
                    </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </body>
</html>