<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Format</title>

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

    <?php echo $error_msg ?>
    <BR>
    

    <form action="." method="post">
        <input type="hidden" name="action" value="add_format">

        <label>Format Name</label>
        <input type="text" placeholder="Name" name="format_name" autofocus required>

        <div class="button-container">
            <button class="add" name="choice" type="submit" value="Add">Add Format</button>
            <button class="add" name="choice" type="submit" value="Back">Go Back</button>
        </div>
    </form>
</div>
</body>
</html>