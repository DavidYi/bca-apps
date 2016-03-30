<?php
    require_once('../util/main.php');
    $user = $_SESSION['user'];
    require_once('../model/presentations_db.php');
    $presentation = Presentation::getPresentationForSenior($user->);
?>
<div section="add">
    <h1>Modify Presentation</h1>

    <BR>
    <form action="index.php" method="post">
        <input type="hidden" name="action" value="modify_presentation">

        <label>Presentation Title</label>
        <input title="" type="text" name="title" required><BR>

        <label>Description</label>
        <input title="" type="text" name="desc" required><BR>

        <label>Organization</label>
        <input title="" type="text" name="organization" required><BR>

        <label>Location</label>
        <input title="" type="text" name="location" required><BR>

        <label>Fields</label>
        <select name="field_id" title=".">
            <?php  foreach ($fields as $field) {?>
                <option value="<?php echo ($field['field_id']);?>"><?php echo($field['field_name']);  ?></option>
            <?php } ?>
        </select>

        <input type="submit" value="Modify">
        <input type="submit" value="Cancel">

        <!-- <a href="index.php?" style="text-decoration: none; color: black"><button>Cancel</button></a> !-->
    </form>
</div>
