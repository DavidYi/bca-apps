<!doctype html>
<html>
<head>

    <meta charset="utf-8">
    <script src="DateTimePicker/jquery-1.9.1.min.js"></script>
    <script src="DateTimePicker/jquery-migrate-1.2.1.min.js"></script>
    <link rel="stylesheet" href="DateTimePicker/jquery-ui.css">
    <script src="DateTimePicker/jquery-1.9.1.js"></script>
    <script src="DateTimePicker/jquery-ui.js"></script>
    <script src="DateTimePicker/jquery-ui-timepicker-addon.js"></script>
    <link rel="stylesheet" href="DateTimePicker/jquery-ui-timepicker-addon.css">

    <script>
        $(function() {
            $( "#datetimepicker" ).datetimepicker();
        });

        $(function() {
            $( "#timepicker" ).timepicker();
        });
    </script>
</head>

<body>
</body>
</html>

<?php
echo '<input type="text" id="datetimepicker" size="12px">';
echo '<input type="text" id="timepicker" size="2px">';
?>