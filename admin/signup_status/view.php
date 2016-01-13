<html>
<head>
    <link rel = "stylesheet" type = "text/css" href = "../main.css" />
    <title>Signup Status</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <script type="text/javascript">
        function autoEnroll(year)
        {
            if (confirm('Are you sure you would like to auto-enroll all ' + year + 'th grade students?')) {
                post("index.php", {action: 'auto_enroll', grade: year}, "post")
            }
        }
        function undoAutoEnroll(year) {
            if (confirm('Are you sure you would like to undo the Auto-Enroll function for the ' + year + 'th grade?')) {
                post("index.php", {action: 'undo_auto_enroll', grade: year}, "post")
            }
        }
        function post(path, params, method) {
            method = method || "post";
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
            </br>
            <h3 class = "title main-title" style ="text-align: center;"><?php echo $result; ?></h3>
        <?php } ?>
    </header>
    <nav class="navbar">
        <a href="#">
            <div class="session-filter grade">Grade Level</div>
            <div class="session-filter full">Fully Enrolled</div>
            <div class="session-filter partial">Partially Enrolled</div>
            <div class="session-filter none">Not Enrolled</div>
            <div class="session-filter auto">Auto-Enroll</div>
            <div class="session-filter dl">Download Student Lists</div>
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
                <div class = "grade">
                    <?php echo $grade; ?>
                </div>
                <div class = "full">
                    <?php echo $full; ?>
                </div>
                <div class = "partial">
                    <?php echo $partial; ?>
                </div>
                <div class = "none">
                    <?php echo $none; ?>
                </div>
                <div class = "auto-enroll">
                    <button onclick= "autoEnroll(<?php echo $grade?>)">Enroll</button>
                    <button onclick= "undoAutoEnroll(<?php echo $grade?>)">Undo Enroll</button>
                </div>
                <div class = "dl">

                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
</body>
</html>
