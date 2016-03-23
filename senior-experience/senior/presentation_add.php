

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
        <input title="" type="text" name="title" required><BR>

        <label>Description</label>
        <input title="" type="text" name="desc" required><BR>

        <label>Organization</label>
        <input title="" type="text" name="organization" required><BR>

        <label>Location</label>
        <input title="" type="text" name="location" required><BR>

        <label>Presenter Names</label>
        <input title="" type="text" name="names" required><BR>

        <label>Fields</label>
        <select name="field" title=".">
            <?php  foreach ($fields as $field) {?>
            <option value="<?php echo ($field['field_id']);?>"><?php echo($field['field_name']);  ?></option>
            <?php } ?>
        </select>

        <label>Rooms</label>
        <select name="room" title=".">
            <!-- Add php stuff !-->
        </select>

        <label>Session</label>
        <select name="session" title=".">
            <!-- Add php stuff !-->
        </select>

        <!-- Add session and room fields with dropdowns !-->
        <!--Integrate with Su Min's dynamic page!-->


        <input type="submit" value="Add">
        <!-- <a href="index.php?" style="text-decoration: none; color: black"><button>Cancel</button></a> !-->
    </form>
</div>
</body>
</html>