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
                left: 25%
            }

            #navbar {
                width: 85%;
            }


        </style>
    </head>
    <body>
        <div class="main">
            <header>
                <h1 class="title">Elective List</h1>

                <button onclick="location.href='./index.php?action=add'" type="submit" id="add_button">Add Elective</button>
                <button onclick="location.href='../index.php'" type="submit" id="back_button">Back</button>
            </header>

            <nav id="navbar" class="navbar">
                <a href="./index.php?action=sort_by_teacher">
                    <div class="session-filter" style="width:15%;text-align:left">Teacher</div>
                </a>
                <a href="./index.php?action=sort_by_elective">
                    <div class="session-filter" style="width:15%;text-align:left">Course Name</div>
                </a>
                <a href="./index.php?action=sort_by_num_students">
                    <div class="session-filter" style="width:50%;text-align:left">Description</div>
                </a>
                <a href="./index.php?action=sort_by_num_students">
                    <div class="session-filter" style="width:15%;text-align:left">Number of Students</div>
                </a>
            </nav>

            <div class="enrollment">
                
            </div>
        </div>
    </body>
</html>