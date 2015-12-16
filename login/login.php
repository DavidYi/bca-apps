<html>
    <head>
        <title>Login</title>
    </head>
    <body>

    <form action="." method="post">
        <input type="hidden" name="action" value="login">
        <select>
            <!-- Loop through each user and add them to dropdown -->
            <?php foreach ($user_list as $user) { ?>
                <option name="usr_id" value="<?php echo $user['usr_id']?>">
                    <?php echo $user['usr_display_name'] ?>
                </option>
            <?php } ?>
        </select>

        <input type="submit" value="Login">
    </form>
    </body>
</html>