<html>
<head>
    <title>Edit Field</title>
    <?php include_analytics() ?>
</head>

<body>
<h1>Edit Field</h1>
<?php echo "<h2>" . $error_msg . "</h2>"?>

<form action="index.php" method="post">
    <input type="hidden" name="action" value="edit_field">
    <input type="hidden" name="field_id" value="<?php echo htmlspecialchars($field['field_id']) ?>">

    <label>
        Field Name
        <input type="text" name="field_name" value="<?php htmlspecialchars($field['field_name']) ?>">
    </label>

    <input type="submit" name="choice" value="Make Changes">
    <input type="submit" name="choice" value="Cancel">
</form>
</body>
</html>