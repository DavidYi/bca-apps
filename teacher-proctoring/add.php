<?php

?>

<html>

    <head>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="styles.css">
        <link href='https://fonts.googleapis.com/css?family=Lato:400,300,700' rel='stylesheet' type='text/css'>
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script src="jquery.timepicker.js"></script>
        <script src="functions.js"></script>
        <script>
        $( document ).ready(function() {
          $('#basicExample').timepicker();
        });
        </script>
    </head>


    <body>
        <input placeholder="Date" type="text" id="datepicker">

        <input placeholder="Location">

        <!-- Test -->

        <input placeholder="Test Type">

        <!-- Time -->

        <input id="basicExample" placeholder="Time" type="text" class="time ui-timepicker-input" autocomplete="off">

    </body>
</html>
