<html>
    <head>
        <title>Mimic User</title>
        <link href="../../../shared/ss/main.css" rel="stylesheet">
        <link href="styles.css" rel="stylesheet">
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
                <button style="background-color: rgb(182, 226, 249); cursor: pointer" type="submit" value="Mimic User" id="submit">Mimic User</button>
                <a href="../index.php"><button style="background-color: rgb(247, 224, 97); cursor: pointer">Back</button></a>
            </div>
        </form>
    </div>
    </body>
</html>