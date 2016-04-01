<?php ?>
<div section="add">
    <h1>Add/Modify Presentation</h1>

    <BR>
    <form action="index.php" method="post">
        <input type="hidden" name="action" value="modify_presentation">

        <label>Presentation Title</label>
        <input title="" type="text" name="title" required value='<?php echo $presentation->pres_title ?>'><BR>

        <label>Description</label>
        <input title="" type="text" name="desc" value='<?php echo $presentation->pres_desc?>' required><BR>

        <label>Organization</label>
        <input title="" type="text" name="organization" value='<?php echo $presentation->organization?>' required><BR>

        <label>Location</label>
        <input title="" type="text" name="location" value='<?php echo $presentation->location ?>'required><BR>

        <label>Fields</label>
        <select name="field_id" title="." value='<?php echo $presentation->field_id?>'>
            <?php  foreach ($fields as $field) {?>
                <option value="<?php echo ($field['field_id']);?>"><?php echo($field['field_name']);  ?></option>
            <?php } ?>
        </select>

        <input type="submit" value="Modify">
        <input type="submit" value="Cancel">

        <!-- <a href="index.php?" style="text-decoration: none; color: black"><button>Cancel</button></a> !-->
    </form>
</div>
