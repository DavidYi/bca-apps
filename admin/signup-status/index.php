
<?php

include('../../util/main.php');
include('../../model/signup_status_db.php');

// add some kind of check here to make sure the user is logged in as an admin
// util/main checks for logged in, don't know how to check for admin permissions

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
                            window.parent.parent.location.href = 'index.php?action=delete_course&course_id=';
                    }
                }
            </script>
    </head>
<body>
<h1>Signup Status</h1>
<table>
        <tr>
                <th>Year</th>
                <th>Fully Enrolled</th>
                <th>Partially Enrolled</th>
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

                    </td>
        
            </tr>
        </tr>
    </table>
</body>
</html>