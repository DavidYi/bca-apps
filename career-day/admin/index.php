<?php
include('../util/main.php');

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'list_options';
    }
}

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
    <link href="../../shared/ss/main.css<?php echo(getVersionString()); ?>" rel="stylesheet">
    <link href="../admin/ss/main.css<?php echo(getVersionString()); ?>" rel="stylesheet">
</head>
<body>
<main>
    <header><h1 class="title"><h2>Admin Tools</h2></h1>
    <div id="logout"><h2><a href="../index.php?action=logout">Log Out</a></h2></div>
    </header>
    <br>
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
                <a href="mentor">
                    <div class="feature">
                        <h2>Mentors</h2>
                        <h4>Manage mentors and presentations.</h4>
                    </div>
                </a>
            </td>
            <td>
                <a href="signins">
                    <div class="feature">
                        <h2>Signins</h2>
                        <h4>Generate signin sheets and mentor check-in sheet.</h4>
                    </div>
                </a>
            </td>
        </tr>
        <tr>
            <td>
                <a href="signup_status">
                    <div class="feature">
                        <h2>Signup Status</h2>
                        <h4>View student registration statistics and automatically enroll students who have not yet registered.</h4>
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
        <tr>
            <td>
                <a href="clear_signups">
                    <div class="feature">
                        <h2>Clear Signups</h2>
                        <h4>Clear All Student Signups.</h4>
                    </div>
                </a>
            </td>
        </tr>
    </table>
    <!-- should probably be /index.php?action=logout in the final, but that won't work right on localhost since everything's in bca-apps rn -->
</main>
</body>
</html>