<!DOCTYPE html>
<html lang="en">
<head>
    <title>Modify Format</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <!-- Styles -->
    <link href="../ss/main.css" rel="stylesheet">

    <style>
        body {
            font-size: 1.66em;
        }
    </style>

</head>
<header>
    <h1 class="title">Admin: Format</h1>
</header>

<body>
<div id="mentor_add">

    <BR>


    <form action="." method="post">
        <input type="hidden" name="action" value="modify_format">
        <input type="hidden" name="format_id" value="<?php echo htmlspecialchars($format_id); ?>">
        <label>Format name</label>
        <input type="text" placeholder="Format Name" name="format_name" value="<?php echo htmlspecialchars($format_name);?>" autofocus required>
        <div class="button-container">
            <button class="add" name="choice" type="submit" value="Modify">Modify Format</button>
            <button class="add" name="choice" type="submit" value="Back">Go Back</button>
        </div>
    </form>
</div>
</body>
</html>