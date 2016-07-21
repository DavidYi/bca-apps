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
    <input type="hidden" name="action" value="update_sessions">

    <div id="box">
        <p class="title">Teacher Sessions</p>

        <div id="header_row">
            <label>
                <span id="name_header"><strong>Name</strong></span>
            </label>
            <label id="role">
                <span id="s1_header"><strong>Session 1</strong></span>
            </label>
            <label id="role">
                <span id="s2_header"><strong>Session 2</strong></span>
            </label>
        </div>

        <?php foreach($teachers as $teacher) { ?>
            <?php $i = 0; ?>

            <div class="row">
                <label>
                    <span class="teacher_name"><?php echo $teacher['usr_name'] ?></span>
                </label>
                <input type="hidden" name="hdUserID[<?php echo $i ?>]" value="<?php echo $teacher['usr_id'] ?>">
                <select name="session1[<?php echo $i ?>]" class="s1_select">
                    <option value="null"></option>
                    <?php foreach($session1 as $pres) { ?>
                        <option value="<?php echo $pres['pres_id'] ?>" <?php if($teacher['pres_id'] == $pres['pres_id']) { ?>selected="selected"<?php } ?>><?php echo $pres['wkshp_nme'] ?> (<?php echo $pres['rm_nbr'] ?>)</option>
                    <?php } ?>
                </select>
                <select name="session2[<?php echo $i ?>]" class="s2_select">
                    <option value="null"></option>
                    <?php foreach($session2 as $pres) { ?>
                        <option value="<?php echo $pres['pres_id'] ?>" <?php if($teacher['pres_id'] == $pres['pres_id']) { ?>selected="selected"<?php } ?>><?php echo $pres['wkshp_nme'] ?> (<?php echo $pres['rm_nbr'] ?>)</option>
                    <?php } ?>
                </select>
            </div>

            <?php $i++; ?>

        <?php } ?>

        <div id="buttons">
            <button class="submit s" type="submit" name="choice" value="Update Teachers">Update</button>
            <button class="submit back" type="submit" name="choice" value="Back">Back</button>
        </div>



</form>
</div>
</body>
</html>
