<?php
include('../util/main.php');

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'list_options';
    }
}

verify_test_admin();

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
    <header><h1 class="title"><h2>Admin Tools</h2></h1>
    <div id="logout"><a href="../index.php?action=logout">Log Out</a></div>
    </header>
    <br>
    <div class="feature">
        <a href="status"><h2>Teacher Status</h2></a>
        <h4>Check tests that an individual teacher signed up for.</h4>
    </div>
    <div class="feature">
        <a href="test_status"><h2>Test Status</h2></a>
        <h4>Check enrolled count and proctoring teachers in a test.</h4>
    </div>
    <?php if ($user->getRole('TPOR') == 'ADM') { ?>
        <div class="feature">
            <a href="roles"><h2>Roles</h2></a>
            <h4>Set user roles for proctoring.</h4>
        </div>
        <div class="feature">
            <a href="room"><h2>Edit Rooms</h2></a>
            <h4>Manage rooms.</h4>
        </div>
        <div class="feature">
            <a href="email"><h2>Email Proctors</h2></a>
            <h4>Notify proctors of an upcoming test.</h4>
        </div>
        <div class="feature">
            <a href="mimic_user"><h2>Mimic User</h2></a>
            <h4>Log in as any user in the database and use the app as if you were them.</h4>
        </div>
        <div class="feature">
            <a href="log_viewer"><h2>Log Viewer</h2></a>
            <h4>View the application log.</h4>
        </div>
    <?php } ?>
    <!-- should probably be /index.php?action=logout in the final, but that won't work right on localhost since everything's in bca-apps rn -->
</main>
</body>
</html>