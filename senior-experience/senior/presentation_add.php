

<html>
<head>

</head>
<body>

<h1>Add Presentation</h1>
<div id="mentor_add">

    <BR>

    <form action="index.php" method="post">
        <input type="hidden" name="action" value="add_pres_into_db">

        <label>Presentation Title</label>
        <input title="" type="text" name="pres_title" required><BR>

        <label>Presentation Description</label>
        <input title="" type="text" name="pres_desc" required><BR>

        <label>Organization</label>
        <input title="" type="text" name="organization" required><BR>

        <label>Location</label>
        <input title="" type="text" name="location" required><BR>

        <label>Field</label>
        <select name="field_id" title=".">
            <?php  foreach ($fields as $field) {?>
            <option value="<?php echo ($field['field_id']);?>"><?php echo($field['field_name']);  ?></option>
            <?php } ?>
        </select><BR>

        <label>Room</label>
        <select name="rm_id" title=".">
            <!-- Add php stuff !-->
        </select><BR>

        <label>Session</label>
        <select name="ses_id" title=".">
            <!-- Add php stuff !-->
        </select><BR>

        <!-- Add session and room fields with dropdowns !-->
        <!--Integrate with Su Min's dynamic page!-->

        <input type="submit" value="Add">
        <!-- <a href="index.php?" style="text-decoration: none; color: black"><button>Cancel</button></a> !-->
    </form>
</div>
</body>
</html>