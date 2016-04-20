<?php ?>
<div section="add">
    <h1>Modify Presentation</h1>

    <BR>
    <form action="index.php" method="post">
        <input type="hidden" name="action" value="modify_presentation">

        <label>Presentation Title</label>
        <input title="" type="text" name="pres_title" required value='<?php echo $pres->pres_title ?>'><BR>

        <label>Description</label>
        <input title="" type="text" name="pres_desc" value='<?php echo $pres->pres_desc?>' required><BR>

        <label>Organization</label>
        <input title="" type="text" name="organization" value='<?php echo $pres->organization?>' required><BR>

        <label>Location</label>
        <input title="" type="text" name="location" value='<?php echo $pres->location ?>'required><BR>

        <label>Fields</label>
        <select name="field_id" title="." value='<?php echo $presentation->field_id?>'>
            <?php  foreach ($fields as $field) {?>
                <option value="<?php echo ($field['field_id']);?>"><?php echo($field['field_name']);  ?></option>
            <?php } ?>
        </select>

        <input type="submit" value="Modify">
        <input type="submit" value="Cancel">

    </form>
</div>
