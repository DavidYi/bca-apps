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
    <header><h1 class="title"><h2>Admin Tools</h1>
    <div id="logout"><a href="../index.php?action=logout">Log Out</a></div>
    </header>
    <br>
    <div class="feature">
        <a href="add"><h2>Add Test</h2></a>
        <h4>Add in a test for teachers to proctor.</h4>
    </div>
    <div class="feature">
        <a href="modify_delete"><h2>Modify/Delete Test</h2></a>
        <h4>Modify or delete an existing test.</h4>
    </div>
    <div class="feature">
        <a href="test_status"><h2>Test Status</h2></a>
        <h4>Check enrolled count and proctoring teachers in a test.</h4>
    </div>

    <!-- should probably be /index.php?action=logout in the final, but that won't work right on localhost since everything's in bca-apps rn -->
</main>
</body>
</html>