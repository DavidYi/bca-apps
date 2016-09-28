<html>
<head>
    <title>Admin Tools</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <!-- Styles -->
    <link href="../admin/main.css" rel="stylesheet">
</head>
<body id="admin-tools">
<main>
    <header><h1 class="title"><h2>Admin Tools</h2></h1>
        <div id="logout"><h2><a href="../index.php?action=logout">Log Out</a></h2></div>
    </header>
    <br>
    <table>
        <tr>
            <td>
                <a href="roles">
                    <div class="feature">
                        <h2>Roles</h2>
                        <h4>Assign administrator roles.</h4>
                    </div>
                </a>
            </td>
            <td>
                <a href="log_viewer">
                    <div class="feature">
                        <h2>Log Viewer</h2>
                        <h4>View the application log.</h4>
                    </div>
                </a>
            </td>
            <td>
                <a href="availability">
                    <div class="feature">
                        <h2>Availability</h2>
                        <h4>Manage teachers' availability.</h4>
                    </div>
                </a>
            </td>
        </tr>
        <tr>
            <td>
                <a href="elective_list">
                    <div class="feature">
                        <h2>Elective List</h2>
                        <h4>Manage all electives.</h4>
                    </div>
                </a>
            </td>
            <td>
                <a href="mimic_user">
                    <div class="feature">
                        <h2>Mimic User</h2>
                        <h4>Log in as any user in the database and use the app as if you were them.</h4>
                    </div>
                </a>
            </td>
            <td>
                <a href="reports">
                    <div class="feature">
                        <h2>Reports</h2>
                        <h4>View elective reports.</h4>
                    </div>
                </a>
            </td>
            <td>
                <a href="clear_data">
                    <div class="feature">
                        <h2>Clear Data</h2>
                        <h4>Clear Data from Database.</h4>
                    </div>
                </a>
            </td>
        </tr>
    </table>

    <!-- should probably be /index.php?action=logout in the final, but that won't work right on localhost since everything's in bca-apps rn -->
</main>
</body>
</html>