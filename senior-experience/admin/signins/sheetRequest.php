<?php
/**
 * Created by PhpStorm.
 * User: daviyi
 * Date: 12/16/15
 * Time: 9:04 AM
 */
?>
<html>
<head>
    <title>Generate Sign in PDF</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../signins.css">
    <link href="../../ss/main.css" rel="stylesheet">

    <script src="http://code.jquery.com/jquery.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('input[type="radio"]').click(function () {
                if ($(this).attr("value") == "s") {
                    $("input[name='action']").val('generates')
                }
                if ($(this).attr("value") == "r") {
                    $("input[name='action']").val('generater')
                }
            });
        });
    </script>
</head>

<header><h1 class="title"><h2>Admin Tools</h1>
</header>

<body>
<br>
<div class="feature">
    <a href="./index.php?action=generates" target="_blank"><h2>Session Sign-ins</h2></a>
    <h4>Generates the PDF for the session sign-ins.</h4></div>
<div class="feature">
    <a href="./index.php?action=generaterc" target="_blank"><h2>Room Signs</h2></a>
    <h4>Generates the room signs</h4></div>
<div class="feature">
    <a href="../index.php"><h2>Back to Menu</h2></a>
    <h4></h4></div>
<div class="feature">
    <a href="../../index.php?action=logout"><h2>Log Out</h2></a>
    <h4></h4></div>

</body>
</html>
