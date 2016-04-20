<html>
<head>
    <title>Add New Room</title>
    <?php include_analytics() ?>
</head>

<body>
<h1>Edit Room</h1>
<?php echo "<h2>" . $error_msg . "</h2>"?>

<form action="index.php" method="post">
    <input type="hidden" name="action" value="edit_room">
    <input type="hidden" name="rm_id" value="<?php echo htmlspecialchars($rm['rm_id']) ?>">

    <label>
        Room Number
        <input type="text" name="rm_nbr" value="<?php echo htmlspecialchars($rm['rm_nbr']) ?>">
    </label>

    <label>
        Room Capacity
        <input type="text" name="rm_cap" value="<?php echo htmlspecialchars($rm['rm_cap']) ?>">
    </label>

    <input type="submit" name="choice" value="Make Changes">
    <input type="submit" name="choice" value="Cancel">
</form>
</body>
</html>