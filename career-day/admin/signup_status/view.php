<html>
<head>
    <link rel = "stylesheet" type = "text/css" href = "../css/main.css<?php echo(getVersionString()); ?>" />
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
    </div>

    <nav class="navbar">
        <a href="#">
            <div class="session-filter grade">Grade Level</div>
            <div class="session-filter full">Fully Enrolled</div>
            <div class="session-filter partial">Partially Enrolled</div>
            <div class="session-filter none">Not Enrolled</div>
            <div class="session-filter auto">Auto-Enroll</div>
        </a>
    </nav>
    <div class = "enrollment">
        <?php foreach ($enroll_list as $year) :
            $grade = $year['grade_lvl'];
            $full = $year['Complete'];
            $partial = $year['Partial'];
            $none = $year['None'];
            ?>
            <div class = "session">
                <div class = "grade" style="font-weight: 400;">
                    <?php echo $grade; ?>
                </div>

                <a href="#" class="full" onclick= "post('index.php', {action: 'all_download', grade: <?php echo $grade ?> }, 'post')" style="font-weight: 400;">
                    <?php echo $full; ?> 
                </a>

                <a href="#" class="partial" onclick="post('index.php', {action: 'partial_download', grade: <?php echo $grade ?>}, 'post')">
                    <?php echo $partial ?>
                </a>

                <a href="#" class="none" onclick= "post('index.php', {action: 'no_download', grade: <?php echo $grade ?>}, 'post')">
                    <?php echo $none; ?>
                </a>

                <div class = "auto-enroll">
                    <button onclick= "autoEnroll(<?php echo $grade?>)">Enroll</button>
                    <button onclick= "undoAutoEnroll(<?php echo $grade?>)">Undo</button>
                </div>
            </div>
        <?php endforeach; ?>
        <br>
    </div>
    <br>
    <br>
    <div class = "center body"><h3>Downloads</h3>
        <a href = "#" onclick= "post('index.php', {action: 'presentation_status'}, 'post')">Presentation Status and List</a>
        <br>
        <a href = "#" onclick= "post('index.php', {action: 'all_registrants'}, 'post')">List of "All Registration Details" for all Students and Teachers</a>
        <br>
        <a href = "#" onclick= "post('index.php', {action: 'all_download'}, 'post')">Fully Enrolled Students List</a>
        <br>
        <a href = "#" onclick= "post('index.php', {action: 'partial_download'}, 'post')">Partially Enrolled Students List</a>
        <br>
        <a href = "#" onclick= "post('index.php', {action: 'no_download'}, 'post')">Unenrolled Students List</a>
        <br>
        <a href = "#" onclick= "post('index.php', {action: 'mentor_download'}, 'post')">Mentor List</a>

    </div>
   </section>
</body>
</html>
