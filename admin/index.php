<?php
include('../util/main.php');

 $action = strtolower(filter_input(INPUT_POST, 'action'));
 if ($action == NULL) {
        $action = strtolower(filter_input(INPUT_GET, 'action'));
        if ($action == NULL) {
                $action = 'list_options';
            }
 }

if ($_SESSION['usr_role_cde'] != 'ADM') {
    header("Location: ../itinerary/index.php");
}
  
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
<head><link rel = "stylesheet" type="text/css" href="css/main.css"></head>
<body>
<section class = "main">
<header><h1 class = "title main-title">Admin Tools</h1></header>
    <div style = "width: 75%; max-width: 1200px; margin-left: auto; margin-right: auto;">
    <p><a href = "signins/index.php">Signins</a><br>
    <a href = "signup_dates/index.php">Signup Dates</a><br>
    <a href = "mentor/index.php">Mentors</a><br>
    <a href = "signup_status/index.php">Signup Status</a></p></div>
    <div id = "logout"><a href = "../index.php?action=logout">Log Out</a></div> <!-- should probably be /index.php?action=logout in the final, but that won't work right on localhost since everything's in bca-apps rn -->
</section>
</body>
</html>

