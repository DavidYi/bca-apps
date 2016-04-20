<html>
<head>
    <title>Add New Room</title>
    <?php include_analytics() ?>
</head>

<body>
<h1>Add New Room</h1>
<?php echo "<h2>" . $error_msg . "</h2>"?>

<form action="index.php" method="post">
    <input type="hidden" name="action" value="add_room">


    <label>
        Room Number
        <input type="text" name="rm_nbr" value="">
    </label>

    <label>
        Room Capacity
        <input type="text" name="rm_cap" value="">
    </label>

    <input type="submit" name="choice" value="Add">
    <input type="submit" name="choice" value="Cancel">
</form>
</body>
</html>