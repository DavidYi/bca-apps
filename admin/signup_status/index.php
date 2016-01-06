
<?php

include('../../util/main.php');
include('../../model/signup_status_db.php');


// add some kind of check here to make sure the user is logged in as an admin
// util/main checks for logged in, don't know how to check for admin permissions

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'display_status';
    }
}

?>



<html>
<head>
        <link rel = "stylesheet" type = "text/css" href = "../main.css" />
        <title>Signup Status</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <script type="text/javascript">
                function autoEnroll(year)
                {
                    if (confirm('Are you sure you would like to auto-enroll all ' + year + 'th grade students?'))
                        {
                            post("index.php", {action: 'auto_enroll', grade: year}, "post")
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
<?php
switch($action) {
    case "display_status":
        $enroll_list = get_registered_users();
?>
<section class="main">
<header>
    <h1 class = "title main-title">Signup Status</h1>
</header>
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
                    </div>
            </div>
        <?php endforeach; ?>
    </div>
    </section>
<?php
        break;
    case "auto_enroll":
        $grade = filter_input(INPUT_POST, 'grade');
        if ($grade == NULL) {
            $grade = filter_input(INPUT_GET, 'grade');
            if ($grade == NULL) {
                $grade = 'Invalid!';
            }
        }
        // $result = mysql_query('CALL getNodeChildren(2)');
        echo $grade;
        break;
}
?>
</body>
</html>
