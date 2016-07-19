<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="view.css" rel="stylesheet" type="text/css" />

</head>
<body>
<form action="index.php" method="post">
    <input type="hidden" name="action" value="modify_admin">

    <div id="box">
        <p class="title">Admin Roles</p>

        <div id="header_row">
            <label>
                <span id="user_header"><strong>User Name</strong></span>
            </label>
            <label id="role">
                <span id="role_header"><strong>Role</strong></span>
            </label>
        </div>

        <?php foreach($assigned_roles as $assigned_user) { ?>

            <div class="user_with_role">
                <label>
                    <span class="user_name"><?php echo $assigned_user['usr_last_name'] ?>, <?php echo $assigned_user['usr_first_name'] ?></span>
                    <span class="user_role"><?php echo $assigned_user['usr_role_desc'] ?></span>
                    <span><a href="./index.php?action=delete_admin&usrID=<?php echo $assigned_user['usr_id'] ?>&roleID=<?php echo $assigned_user['usr_role_cde'] ?>"><img src="../../../shared/images/deleteIcon.gif" /></a></span>
                </label>
            </div>

        <?php } ?>
        
        <div id="add">
            <span id="add_header"><strong>Add Admin</strong></span><br>
            <select id="user_drop" name="user_drop">
                <?php foreach($users as $user) { ?>
                    <option value="<?php echo $user['usr_id'] ?>"><?php echo $user['usr_last_name'] ?>, <?php echo $user['usr_first_name'] ?></option>
                <?php } ?>
            </select>
            <select id="role_drop" name="role_drop">
                <?php foreach($roles as $role) { ?>
                    <option value="<?php echo $role['usr_role_cde'] ?>"><?php echo $role['usr_role_desc'] ?></option>
                <?php } ?>
            </select>
            <button class="submit s" type="submit" name="choice" value="Add Admin">Submit</button>
            <button class="submit cancel" type="submit" name="choice" value="Back">Cancel</button>
        </div>



</form>
</div>
</body>
</html>
