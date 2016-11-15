<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Add Workshop</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

        <!-- Styles -->
        <link href="../../../shared/ss/main.css" rel="stylesheet">
        <link href="styles2.css" rel="stylesheet">

    </head>

    <body>
        <form action="." method="post">
            <input type="hidden" name="action" value="add_workshop">

            <div id="box">
                <div id="wrapper">
                    <div id ="columns">
                        <h1 class="title">Add Workshop</h1>

                        <table>
                            <tr>
                                <td>
                                    <label>Name</label>
                                </td>
                                <td>
                                    <input type="text" name="wkshp_name" autofocus required>
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
                                            <option value=<?php echo($format['format_id']); ?>><?php echo($format['format_name']); ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                        </table>
                        

                        <div id="button-div">
                            <button style="cursor: pointer" class="submit s" type="submit" name="choice" value="Add">Submit</button>
                            <button style="cursor: pointer" class="submit b" type="submit" name="choice" value="Back" formnovalidate>Cancel</button>
                        </div>


                    </div>
                </div>
        </form>
    </body>
</html>