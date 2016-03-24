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
    <link href="../admin/ss/main.css" rel="stylesheet">
</head>
<body>
<main>
    <header><h1 class="title"><h2>Admin Tools</h1>
    <div id="logout"><a href="../index.php?action=logout">Log Out</a></div>
    </header>
    <br>
    <div class="feature">
        <a href="signup_dates"><h2>Signup Dates</h2></a>
        <h4>View and edit signup deadlines by grade.</h4></div>
    <div class="feature">
        <a href="mentor"><h2>Mentors</h2></a>
        <h4>Manage mentors and presentations.</h4></div>
    <div class="feature">
        <a href="signins"><h2>Signins</h2></a>
        <h4>Generate signin sheets and mentor check-in sheet.</h4></div>
    <div class="feature">
        <a href="signup_status"><h2>Signup Status</h2></a>
        <h4>View student registration statistics and automatically enroll students who have not yet registered.</h4></div>
    <div class="feature">
        <a href="mimic_user"><h2>Mimic User</h2></a>
        <h4>Log in as any user in the database and use the app as if you were them.</h4></div>
    <div class="feature">
        <a href="log_viewer"><h2>Log Viewer</h2></a>
        <h4>View the application log.<h4></h4></div>

    <!-- should probably be /index.php?action=logout in the final, but that won't work right on localhost since everything's in bca-apps rn -->
</main>
</body>
</html>