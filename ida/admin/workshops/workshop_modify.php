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

                <table>
                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" name="wkshp_name" value="<?php echo htmlspecialchars($wkshp_nme); ?>" autofocus required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Description</label>
                        </td>
                        <td>
                            <textarea rows="4" cols="50" class="center" type="text" name="wkshp_desc" value="<?php echo htmlspecialchars($wkshp_desc); ?>"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Format</label>
                        </td>
                        <td>
                            <select class="center" name="format_id">
                                <?php foreach ($formatList as $format) { ?>
                                    <option value=<?php echo($format['format_id']); ?>
                                            <?php if ($format_id == $format['format_id']) echo(" selected "); ?>
                                    ><?php echo($format['format_name']); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                </table>


                <div id="button-div">
                    <button class="submit s" type="submit" name="choice" value="Modify">Submit</button>
                    <button class="submit b" type="submit" name="choice" value="Back" formnovalidate>Cancel</button>
                </div>

            </div>
        </div>
</form>
</body>
</html>