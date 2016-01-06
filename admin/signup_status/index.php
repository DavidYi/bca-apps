
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
        <link rel = "stylesheet" type = "text/css" href = "../../ss/main.css" />
        <title>Signup Status</title>
        <script type="text/javascript">
                function autoEnroll(year)
                {
                    if (confirm('Are you sure you would like to randomly enroll all unenrolled students in presentations?'))
                        {
                            post("index.php", {action: 'auto_enroll'}, "post")
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
            <style>
                td {
                    width: 100px;
                    text-align:center;
                    border-width: 2px;
                }
                button {
                    width: 8.75em;
                    height: 2.5em;
                }
                table {
                    border-spacing: 1px;
                    border-width: 2px;
                    height: 50%;
                }
            </style>
    </head>
<body>
<?php
switch($action) {
    case "display_status":
?>

<h1 class = "register">Signup Status</h1>
<br>
<table class = "enrollment">
        <tr>
                <th>Grade</th>
                <th>Full</th>
                <th>Partial</th>
                <th>Not Enrolled</th>
                <th>Auto-Enroll</th>
            </tr>
        <tr>
                <td>

                    </td>
                <td>

                    </td>
                <td>

                    </td>
                <td>

                    </td>
                <td>
                    <button onclick= "autoEnroll(0)">Enroll</button>
                    </td>
        
            </tr>
        </tr>
    </table>
<?php
        break;
    case "auto_enroll":
        // $result = mysql_query('CALL getNodeChildren(2)');
        echo "filler text";

        break;
}
?>
</body>
</html>
