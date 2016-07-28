<html>
    <head>
        <link rel="stylesheet" href="../css/main.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <script type="text/javascript" src="../../js/jquery.min.js"></script>
        <script type="text/javascript" src="../../js/jquery.easing.min.js"></script>
        <script type="text/javascript" src="../../js/jquery.plusanchor.min.js"></script>
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
                display: block;
                margin-right: 0%;
                width: 15%;
                height: 3.25em;
                color: #555;
                margin: 0;
                padding: 0;
                font-size: 1em;
                font-weight: 500;
                text-align: left;
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
                width: 15.5%;
            }

            .course-name {
                width: 17%;
            }

            .course-desc {
                width: 55%;
            }

            .num-students {
                width: 10%;
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
                    <div class="session-filter" style="width:15%;text-align:left">Teacher</div>
                </a>
                <a href="./index.php?action=sort_by_elective">
                    <div class="session-filter" style="width:16.5%;text-align:left">Course Name</div>
                </a>
                <a>
                    <div class="session-filter" style="width:54%;text-align:left">Description</div>
                </a>
                <a href="./index.php?action=sort_by_num_students">
                    <div class="session-filter" style="width:13%;text-align:left">Number of Students</div>
                </a>
            </nav>

            <div class="enrollment">
                <?php foreach($elective_list as $elective) :
                    $teacher_name = $elective['teacher_name'];
                    $course_name = $elective['course_name'];
                    $course_desc = $elective['course_desc'];
                    $num_students = $elective['num_students'];
                    ?>

                    <div class="main-panel session">
                        <div class="cell teacher-name"><?php echo $teacher_name; ?></div>
                        <div class="cell course-name"><?php echo $course_name; ?></div>
                        <div class="cell course-desc"><?php echo $course_desc; ?></div>
                        <div class="cell num-students"><?php echo $num_students; ?></div>
                        
                    </div>
                    
                <?php endforeach; ?>
            </div>
        </div>
    </body>
</html>