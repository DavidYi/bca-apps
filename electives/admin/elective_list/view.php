<html>
    <head>
        <link rel="stylesheet" href="../css/main.css">
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
            button {
                background-color: #ffcc00;
                position: absolute;
                top: 20%;
                height: 80px;
                width: 120px;
                font-size: 20px;
            }

            #add_button {
                right:25%;
                line-height: 1.5em;
            }

            #back_button {
                left: 25%;
            }

            #navbar {
                width: 85%;
            }

            .cell {
                float: left;
                display: inline-block;
                margin-right: 0%;
                width: 15%;
                height: 3.25em;
                color: #555;
                margin: 0;
                padding: 0;
                font-size: 1em;
                font-weight: 500;
                text-align: left;
                vertical-align:middle;
            }

            .enrollment {
                height:75%;
                width 85%;
            }

            .main-panel {
                width: 100%;
                height: 3.25em;
                position: relative;
            }

            .teacher-name {
                width: 13%;
            }

            .course-name {
                width: 15%;
            }

            .course-desc {
                width: 53%;
            }

            .center-text {
                line-height: 1.4em;
                vertical-align: middle;
                display:table;
            }

            .num-students {
                width: 6%;
                text-align: center;
            }

            .icon {
                vertical-align:middle;
            }

            .edit {
                text-align:center;
                width:6%;
            }

            .delete {
                text-align:center;
                width: 6%;
            }

            .helper {
                display: inline-block;
                height: 100%;
                vertical-align: middle;
            }

            .center-text p {
                display: table-cell;
                vertical-align:middle;
                font-size: 1em;
                font-weight: 300;
            }

            #course-desc-p {
                font-weight: 500;
            }
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
                <a href="./index.php">
                    <div class="session-filter" style="width:13%;">Teacher</div>
                </a>
                <a href="./index.php?action=sort_by_elective">
                    <div class="session-filter" style="width:14%;">Course Name</div>
                </a>
                <a>
                    <div class="session-filter" style="width:53%;">Description</div>
                </a>
                <a href="./index.php?action=sort_by_num_students">
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