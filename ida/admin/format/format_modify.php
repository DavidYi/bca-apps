<!DOCTYPE html>
<html lang="en">
<head>
    <title>Modify Format</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <!-- Styles -->
    <link href="../../../shared/ss/main.css" rel="stylesheet">
    <link href="styles2.css" rel="stylesheet">

</head>

<body>
<form action="." method="post">
    <input type="hidden" name="action" value="modify_format">
    <div id="box">
        <div id="wrapper">
            <div id ="columns">
                <h1 class="title">Modify Format</h1>

                <input type="hidden" name="action" value="modify_format">
                <input type="hidden" name="format_id" value="<?php echo htmlspecialchars($format_id); ?>">
                <label>Format name</label>
                <input type="text" placeholder="Format Name" name="format_name" value="<?php echo htmlspecialchars($format_name);?>" autofocus required>

                <div id="button-div">
                    <button style="cursor: pointer" class="submit s" type="submit" name="choice" value="Modify">Submit</button>
                    <button style="cursor: pointer" class="submit b" type="submit" name="choice" value="Back" formnovalidate>Cancel</button>
                </div>
            </div>
        </div>
</form>
</body>
</html>