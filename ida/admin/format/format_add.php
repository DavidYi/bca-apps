<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Format</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <!-- Styles -->
    <link href="../../../shared/ss/main.css<?php echo(getVersionString()); ?>" rel="stylesheet">
    <link href="styles2.css<?php echo(getVersionString()); ?>" rel="stylesheet">

</head>
<body>
<form action="." method="post">
    <input type="hidden" name="action" value="add_format">
    <div id="box">
        <div id="wrapper">
            <div id ="columns">
                <h1 class="title">Add Format</h1>

                <input type="hidden" name="action" value="add_format">

                <label>Format Name</label>
                <input type="text" name="format_name" autofocus required>

                <div id="button-div">
                    <button style="cursor: pointer" class="submit s" type="submit" name="choice" value="Add">Submit</button>
                    <button style="cursor: pointer" class="submit b" type="submit" name="choice" value="Back" formnovalidate>Cancel</button>
                </div>
            </div>
        </div>
</form>
</body>
</html>