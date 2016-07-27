<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/<?php echo $app_url_path ?>/../shared/roles/view.css" rel="stylesheet" type="text/css" />
    <link href="../../../shared/ss/main.css" rel="stylesheet" type="text/css" />
</head>
<body>
<form action="index.php" method="post">
    <input type="hidden" name="action" value="modify_admin">

    <div id="box">
        <div id="wrapper">
            <div id="columns">
                <h1 class="title">Admin Roles</h1>

                <div id="users">
                    <h2><strong>User</strong></h2>
                    <?php foreach($assigned_roles as $assigned_user) { ?>
                        <h2 class="user"><?php echo $assigned_user['usr_last_name'] ?>, <?php echo $assigned_user['usr_first_name'] ?></h2>
                    <?php } ?>
                </div>

                <div id="se-wrap">
                    <div id="role">
                        <h2><strong>Role</strong></h2>
                        <?php foreach($assigned_roles as $assigned_user) { ?>
                            <h2><?php echo $assigned_user['usr_role_desc'] ?></h2>
                        <?php } ?>
                    </div>
                    <div id="delete">
                        <?php foreach($assigned_roles as $assigned_user) { ?>
                        <a href="index.php?action=delete_admin&usrID=<?php echo $assigned_user['usr_id'] ?>&roleID=<?php echo $assigned_user['usr_role_cde'] ?>"><h4>d</h4></a>
                        <?php } ?>
                    </div>
                </div>
            </div>

<!--            <div id="add">-->
<!--                <h2><strong>Add Admin</strong></h2>-->
<!--                <select id="user_drop" name="user_drop">-->
<!--                    --><?php //foreach($users as $user) { ?>
<!--                        <option value="--><?php //echo $user['usr_id'] ?><!--">--><?php //echo $user['usr_last_name'] ?><!--, --><?php //echo $user['usr_first_name'] ?><!--</option>-->
<!--                    --><?php //} ?>
<!--                </select>-->
<!--                <select id="role_drop" name="role_drop">-->
<!--                    --><?php //foreach($roles as $role) { ?>
<!--                        <option value="--><?php //echo $role['usr_role_cde'] ?><!--">--><?php //echo $role['usr_role_desc'] ?><!--</option>-->
<!--                    --><?php //} ?>
<!--                </select>-->
<!--                <button class="submit s" type="submit" name="choice" value="Add Admin">Add</button>-->
<!--            </div>-->
<!--            -->
<!--        <button class="submit back" type="submit" name="choice" value="Back">Back</button>-->
        </div>
    </div>
</form>
</body>
</html>
