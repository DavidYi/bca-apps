<?php
include('../util/main.php');

if (!isset($_SESSION))
    session_start();

// add some kind of check here to make sure the user is logged in as an admin
// util/main checks for logged in, don't know how to check for admin permissions

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
    <a href = "signup_dates/index.php">Signup Dates</a></p>
</body>
</html>
