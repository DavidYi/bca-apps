<?php
/**
 * Created by PhpStorm.
 * User: daviyi
 * Date: 12/16/15
 * Time: 9:04 AM
 */
?>
<html>
<head>
    <title>Generate Sign in PDF</title>
</head>
<body>

    <form action="." method="post">
        <input type="hidden" name="action" value="login">
        <select name="usr_id"  title="usr_id">
            <!-- Loop through each user and add them to dropdown -->
            <?php foreach ($user_list as $user) { ?>
                <option value="<?php echo htmlspecialchars($user['usr_id'])?>">
                    <?php echo $user['usr_display_name'] ?>
                </option>
            <?php } ?>
        </select>

        <input type="submit" value="Login">
    </form>
</body>
</html>