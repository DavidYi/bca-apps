<!doctype html>
<html>
<head>

    <meta charset="utf-8">
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script src="http://trentrichardson.com/examples/timepicker/jquery-ui-timepicker-addon.js"></script>
    <link rel="stylesheet" href="http://trentrichardson.com/examples/timepicker/jquery-ui-timepicker-addon.css">

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