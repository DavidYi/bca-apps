<?php
include('../util/main.php');
$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'list_options';
    }
}

// add some kind of check here to make sure the user is logged in as an admin
// util/main checks for logged in, don't know how to check for admin permissions

switch($action) {
    case 'list_options':
        break;
    case 'auto_enroll':
        //code here
        break;
    default:
        display_error('Unknown account action: ' . $action);
        exit();
        break;
}
?>

<html>
<head>
    <link rel = "stylesheet" type = "text/css" href = "../ss/main.css" />
    <title>Admin Directory</title>
</head>
<body>
<h1>Admin Tools</h1>
<p><a href = "signins/index.php">Signins</a><br>
<a href = "signup_dates/index.php">Signup Dates</a><br>
<a href = "signup_status/index.php">Signup Status</a></p>
</body>
</html>
