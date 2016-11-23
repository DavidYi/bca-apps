<html>

<head>
    <link rel="stylesheet" href="../../../shared/ss/main.css">
    <link rel="stylesheet" href="styles.css">
    <title>Signup Status</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <script type="text/javascript">
        function autoEnroll(year)
        {
            if (confirm('Are you sure you would like to auto-enroll all ' + year + 'th grade students?')) { //js prompt; includes year for debugging
                post("index.php", {action: 'auto_enroll', grade: year}, "post")
            }
        }
        function undoAutoEnroll(year) {
            if (confirm('Are you sure you would like to undo the Auto-Enroll function for the ' + year + 'th grade?')) {
                post("index.php", {action: 'undo_auto_enroll', grade: year}, "post")
            }
        }
        function post(path, params, method) { //sends a post request; used to avoid having to use get to change the url since that looks sloppy and i don't want to bother with an inline form, especially if i want the confirmation prompt
            method = method || "post"; //also ripped straight off stackoverflow
            var form = document.createElement("form");
            form.setAttribute("method", method);
            form.setAttribute("action", path);

            for(var key in params) {
                if(params.hasOwnProperty(key)) {
                    var hiddenField = document.createElement("input");
                    hiddenField.setAttribute("type", "hidden");
                    hiddenField.setAttribute("name", key);
                    hiddenField.setAttribute("value", params[key]);

                    form.appendChild(hiddenField);
                }
            }

            document.body.appendChild(form);
            form.submit();
        }
    </script>
</head>
<body>
<section class="main">

    <header>
        <h1 class = "title main-title">Signup Status</h1>
        <?php if ($result != "") { ?>
            <h3 class = "title main-title" style ="text-align: center;"><?php echo $result; ?></h3>
        <?php } ?>
    </header>
    <div class="buttons" style="text-align:center;padding-bottom:2vh;">
        <a href="../index.php"><button class="b">Back</button></a>
        <!--<a href="../../index.php?action=logout"><button class="logout">Log Out</button></a>-->
    </div>


    <nav class="navbar">
        <a href="#"><div class="session-filter grade"><h2>Grade </h2></div></a>
        <a href="#"><div class="session-filter full"><h2>Fully </h2></div></a>
        <a href="#"><div class="session-filter partial"><h2>Partially </h2></div></a>
        <a href="#"><div class="session-filter none"><h2>Not</h2></div></a>
        <a href="#"><div class="session-filter auto"><h2>Auto-Enroll</h2></div></a>
    </nav>
    <div class = "list-container">
        <?php foreach ($enroll_list as $year) :
            $grade = $year['grade_lvl'];
            $full = $year['Complete'];
            $partial = $year['Partial'];
            $none = $year['None'];
            ?>
            <div class = "session">
                <div class = "grade" style="font-weight: 400;">
                    <?php if ($grade != 13) { ?>
                        <h2><?php echo $grade; ?></h2>
                    <?php } else { ?>
                    <h2>Teachers</h2>
                    <?php } ?>
                </div>

                <a href="#" class="full" onclick= "post('index.php', {action: 'all_download', grade: <?php echo $grade ?> }, 'post')" style="font-weight: 400;">
                    <h2><?php echo $full; ?></h2>
                </a>

                <a href="#" class="partial" onclick="post('index.php', {action: 'partial_download', grade: <?php echo $grade ?>}, 'post')">
                    <h2><?php echo $partial ?></h2>
                </a>

                <a href="#" class="none" onclick= "post('index.php', {action: 'no_download', grade: <?php echo $grade ?>}, 'post')">
                    <h2><?php echo $none; ?></h2>
                </a>


                <div class = "auto-enroll">
                    <?php if ($grade != 13) { ?>
                        <a onclick= "autoEnroll(<?php echo $grade?>)"><h4>e</h4></a>
                        <a onclick= "undoAutoEnroll(<?php echo $grade?>)"><h4>u</h4></a>
                    <?php } ?>
                </div>

            </div>
        <?php endforeach; ?>
    </div>
    <br>
    <br>
    <div class = "center body"><h1 class="title">Downloads</h1>
        <div class="downloads"><a href = "#" onclick= "post('index.php', {action: 'presentation_status'}, 'post')"><h4>h</h4><h2>Presentation Status and List</h2></a>
        <br>
        <a href = "#" onclick= "post('index.php', {action: 'all_registrants'}, 'post')"><h4>h</h4><h2>List of "All Registration Details" for all Students and Teachers</h2></a>
        <br>
        <a href = "#" onclick= "post('index.php', {action: 'partial_download'}, 'post')"><h4>h</h4><h2>List of "Partially Enrolled" Students and Teachers</h2></a>
        <br>
        <a href = "#" onclick= "post('index.php', {action: 'no_download'}, 'post')"><h4>h</h4><h2>List of "Not Enrolled" Students and Teachers</h2></a>
        </div>
    </div>
</section>
</body>
</html>
