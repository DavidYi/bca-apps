<html>
    <head>
        <title>Mimic User</title>
    </head>
    <body>
        <form action="." method="post">
            <input type="hidden" name="action" value="login">

            <label for="usr_id">Select User</label>
            <select name="usr_id" id="usr_id">
                <?php foreach ($user_list as $user) { ?>
                    <option value="<?php echo $user['usr_id']?>">
                        <?php echo $user['usr_class_year']?>,
                        <?php echo $user['usr_last_name']?>,
                        <?php echo $user['usr_first_name'] ?>
                    </option>
                <?php } ?>
            </select>

            <input type="submit" value="Mimic User">

            <input type="checkbox" name="bypass_time" value="Allow Signups"> Allow Signups
        </form>
    </body>
</html>