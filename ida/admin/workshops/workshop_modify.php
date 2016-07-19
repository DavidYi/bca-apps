<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin: Workshop</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <!-- Styles -->
    <link href="../../admin/ss/main.css" rel="stylesheet">
    <link href="/styles.css" rel="stylesheet">
    <style>
        body {
            font-size: 1.66em;
        }
    </style>
</head>
<body>
<header>
    <h1 class="title">Editing: <?php echo htmlspecialchars($wkshp_nme); ?></h1>
</header>
<form action="index.php?action=modify_workshop" method="post">
    <input type="hidden" name="action" value="modify_workshop">
    <input type="hidden" name="workshop_id" value="<?php echo htmlspecialchars($workshop_id); ?>">

    <label>Name</label>
    <input type="text" placeholder="Name" name="wkshp_name"
           value="<?php echo htmlspecialchars($wkshp_nme); ?>" autofocus required>
    <label>Description</label>
    <textarea rows="4" cols="50" class="center" type="text" name="wkshp_desc"
              value="<?php echo htmlspecialchars($wkshp_desc);?>" placeholder="Description"><?php echo htmlspecialchars($wkshp_desc);?>
    </textarea>
    <label>Format</label>
    <select class="center" name="format_id">
        <?php foreach ($formatList as $format) {?>
            <option value=<?php echo($format['format_id']); ?>><?php echo($format['format_name']); ?></option>
        <?php } ?>
    </select>
    <div class="button-container">
            <button class="add" name="choice" type="submit" value="Modify">Save Changes</button>
            <button class="add" name="choice" type="submit" value="Back">Go Back</button>
    </div>
</form>

</body>
</html>