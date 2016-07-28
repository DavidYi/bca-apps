<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Workshop</title>

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
    <h1 class="title">Admin: Workshop</h1>
</header>

<body>
<div id="mentor_add">

    <?php echo $error_msg ?>
    <BR>
    

    <form action="." method="post">
        <input type="hidden" name="action" value="add_workshop">

        <label>Name</label>
        <input type="text" placeholder="Name" name="wkshp_name" autofocus required>
        <label>Description</label>
    <textarea rows="4" cols="50" class="center" type="text" name="wkshp_desc" value="<?php echo htmlspecialchars($wkshp_desc);?>" placeholder="Description"></textarea>
        <label>Format</label>
        <select class="center" name="format_id">
            <?php foreach ($formatList as $format) {?>
                <option value=<?php echo($format['format_id']); ?>><?php echo($format['format_name']); ?></option>
            <?php } ?>
        </select>
        <div class="button-container">
            <button class="add" name="choice" type="submit" value="Add">Add Workshop</button>
        </div>
    </form>
    <a href="../workshops/index.php"<button class="add" name="choice" type="submit" value="Back">Go Back</button></a>
</div>
</body>
</html>