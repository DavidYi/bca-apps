<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Admin: Workshop</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

        <!-- Styles -->
        <link href="../../../shared/ss/main.css" rel="stylesheet">
        <link href="styles2.css" rel="stylesheet">
    </head>
    <body>
        <form action="index.php?action=modify_workshop" method="post">
            <input type="hidden" name="action" value="modify_workshop">
            <input type="hidden" name="workshop_id" value="<?php echo htmlspecialchars($workshop_id); ?>">


            <div id="box">
                <div id="wrapper">
                    <div id ="columns">
                        <h1 class="title">Modify: <?php echo htmlspecialchars($wkshp_nme); ?></h1>

                        <input type="text" placeholder="Name" name="wkshp_name" value="<?php echo htmlspecialchars($wkshp_nme); ?>" autofocus required>
                        <br>

                        <textarea rows="4" cols="50" class="center" type="text" name="wkshp_desc" placeholder="Description"><?php echo htmlspecialchars($wkshp_desc); ?></textarea>
                        <br>

                        <label>Format</label>
                        <select class="center" name="format_id">
                            <?php foreach ($formatList as $format) { ?>
                                <option value=<?php echo($format['format_id']); ?>><?php echo($format['format_name']); ?></option>
                            <?php } ?>
                        </select>
                        <br>

                        <div id="button-div">
                            <button class="submit s" type="submit" name="choice" value="Modify">Save Changes</button>
                            <button class="submit cancel" type="submit" name="choice" value="Back">Cancel</button>
                        </div>

                    </div>
                </div>
        </form>
    </body>
</html>