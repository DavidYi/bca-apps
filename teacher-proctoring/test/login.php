<html>
    <head>
        <title>Login</title>
    </head>
    <body>

    <form action="." method="post">
        <input type="hidden" name="action" value="login">
        <select name="usr_id"  title="usr_id">
            <!-- Loop through each user and add them to the dropdown -->
            <?php foreach ($user_list as $user) { ?>
                <option value="<?php echo $user['usr_id']?>">
                    <?php echo $user['usr_type_cde'] ?> &nbsp
                    <?php echo $user['usr_grade_lvl']?> -
                    <?php echo $user['usr_last_name']?>,
                    <?php echo $user['usr_first_name'] ?>
                    <?php echo $user['usr_role_cde'] ?>
                </option>
            <?php } ?>
        </select>

        <input type="submit" value="Login">
    </form>
    </body>
</html>