<html>
<head>
    <title>Add New Field</title>
    <?php include_analytics() ?>
</head>

<body>
<h1>Add New Field</h1>
<?php echo "<h2>" . $error_msg . "</h2>"?>

<form action="index.php" method="post">
    <input type="hidden" name="action" value="add_field">

    <label>
        Field Name
        <input type="text" name="field_name" value="<?php echo htmlspecialchars($field_name) ?>">
    </label>

    <input type="submit" name="choice" value="Add">
    <input type="submit" name="choice" value="Cancel">
</form>
</body>
</html>