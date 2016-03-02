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
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
<section class="main">
    <header><h1 class="title main-title">Admin Tools</h1></header>
    <div class="body">
        <p><a href="signup_dates">Signup Dates</a><br>
            View and edit signup deadlines by grade.</p>
        <p><a href="mentor">Mentors</a><br>
            Manage mentors and presentations.</p>
        <p><a href="signins">Signins</a><br>
            Generate signin sheets and mentor check-in sheet.</p>
        <p><a href="signup_status/">Signup Status</a><br>
            View student registration statistics and automatically enroll students who have not yet registered.</p>
        <p><a href="mimic_user">Mimic User</a><br>
            Log in as any user in the database and use the app as if you were them.</p>
    </div>
    <div id="logout"><a href="../index.php?action=logout">Log Out</a></div>
    <!-- should probably be /index.php?action=logout in the final, but that won't work right on localhost since everything's in bca-apps rn -->
</section>
</body>
</html>

