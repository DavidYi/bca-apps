<html>
    <head>
        <title>Mimic User</title>
        <link href="../../../shared/ss/main.css<?php echo(getVersionString()); ?>" rel="stylesheet">
        <link href="styles.css<?php echo(getVersionString()); ?>" rel="stylesheet">
    </head>
    <body>
    <div id="login">
        <form action="." method="post">
            <input type="hidden" name="action" value="login">

            <h1 class="title">Select User</h1>
            <select name="usr_id" id="usr_id">
                <?php foreach ($user_list as $user) { ?>
                    <option value="<?php echo $user['usr_id']?>">
                           <?php echo $user['usr_class_year']?>,
                        <?php echo $user['usr_last_name']?>,
                        <?php echo $user['usr_first_name'] ?>
                    </option>
                <?php } ?>
            </select>
            <br>
            <div id="padding"></div>
            <div id="button-div">
                <button name="choice" value="submit" id="submit" class="s">Mimic User</button>
                <button name="choice" value="back" id="back" class="b">Back</button>
            </div>
        </form>
    </div>
    </body>
</html>