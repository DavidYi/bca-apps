<html>
    <head>
        <title>Login</title>
    </head>
    <body>

    <form action="." method="post">
        <input type="hidden" name="action" value="login">
        <select name="usr_id"  title="usr_id">
            <!-- Loop through each user and add them to dropdown -->
            <?php foreach ($user_list as $user) { ?>
                <option value="<?php echo $user['usr_id']?>">
                    <?php echo $user['usr_last_name']?>,
                    <?php echo $user['usr_first_name'] ?>
                </option>
            <?php } ?>
        </select>

        <input type="submit" value="Login">
    </form>
    </body>
</html>