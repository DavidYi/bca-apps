<?php
include('../util/main.php');

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'list_options';
    }
}
//some change
verify_admin();

switch ($action) {
    case 'list_options':
        break;
    default:
        display_error('Unknown account action: ' . $action);
        exit();
        break;
}
?>

<html>
<head>
    <title>Admin Tools</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <!-- Styles -->
    <link href="../../shared/ss/main.css" rel="stylesheet">
    <link href="../admin/ss/main.css" rel="stylesheet">
</head>
<body id="admin-tools">
<main>
    <header><h1 class="title"><h2>Admin Tools</h2></h1>
        <div id="logout"><h2><a href="../index.php?action=logout">Log Out</a></h2></div>
    </header>
    <br>
    <div id="wrapper">
    <table>
        <tr>
            <td>
                <a href="signup_dates">
                    <div class="feature">
                        <h2>Signup Dates</h2>
                        <h4>View and edit signup deadlines by grade.</h4>
                    </div>
                </a>
            </td>
            <td>
                <a href="workshops">
                    <div class="feature">
                        <h2>Workshops</h2>
                        <h4>Manage workshops.</h4>
                    </div>
                </a>
            </td>
            <td>
                <a href="presentations">
                    <div class="feature">
                        <h2>Presentations</h2>
                        <h4>Manage presentations.</h4>
                    </div>
                </a>
            </td>
            <td>
                <a href="room">
                    <div class="feature">
                        <h2>Rooms</h2>
                        <h4>Manage rooms.</h4>
                    </div>
                </a>
            </td>
        </tr>
        <tr>
            <td>
                <a href="format">
                    <div class="feature">
                        <h2>Formats</h2>
                        <h4>Manage formats.</h4>
                    </div>
                </a>
            </td>
            <td>
                <a href="session_times">
                    <div class="feature">
                        <h2>Session Times</h2>
                        <h4>Manage when each session will take place.</h4>
                    </div>
                </a>
            </td>
            <td>
                <a href="signins">
                    <div class="feature">
                        <h2>Signins</h2>
                        <h4>Generates signin sheets, a presenter check-in sheet, and room signs.</h4>
                    </div>
                </a>
            </td>
            <td>
                <a href="signup_status">
                    <div class="feature">
                        <h2>Signup Status</h2>
                        <h4>View student registration statistics and automatically enroll students who have not yet registered.</h4>
                    </div>
                </a>
            </td>
        </tr>
        <tr>
            <td>
                <a href="teacher_sessions">
                    <div class="feature">
                        <h2>Teacher Sessions</h2>
                        <h4>Assign teachers to sessions.</h4>
                    </div>
                </a>
            </td>
            <td>
                <a href="roles">
                    <div class="feature">
                        <h2>Roles</h2>
                        <h4>Assign administrator roles.</h4>
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
                <a href="log_viewer">
                    <div class="feature">
                    <h2>Log Viewer</h2>
                        <h4>View the application log.</h4>
                    </div>
                </a>
            </td>
        </tr>
    </table>
    </div>

    <!-- should probably be /index.php?action=logout in the final, but that won't work right on localhost since everything's in bca-apps rn -->
</main>
</body>
</html>