<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../../../shared/ss/main.css" rel="stylesheet">
    <link href="view.css" rel="stylesheet" type="text/css"/>

</head>


<body>
<form action="index.php" method="post">
    <input type="hidden" name="action" value="update_sessions">
    <header>
        <h1 class="title">Teacher Sessions</h1>
    </header>
    <div class="button-wrap">
        <button type="submit" class="submit s" name="choice" value="Update Teachers">Submit</button>
        <button type="submit" class="submit cancel" name="choice" value="Back">Back</button>
    </div>
    <nav style="width:65%" class="navbar">
        <div id="navinside">
            <a href="#">
                <div id="name_header" class="session-filter"><h2><strong>Name</strong></h2></div>
            </a>
            <a href="#">
                <div id="s1_header" class="session-filter"><h2><strong>Session 1</strong></h2></div>
            </a>
            <a href="#">
                <div id="s2_header" class="session-filter"><h2><strong>Session 2</strong></h2></div>
            </a>
        </div>
    </nav>

    <div style="width:65%;" class="list-container" id="teacher_div">

        <?php $i = 0; ?>
        <?php foreach ($teachers as $teacher) { ?>

        <div class="mentor" id="workshop">
        <label>
            <span class="teacher_name"><?php echo $teacher['usr_name'] ?></span>
        </label>
        <input type="hidden" name="hdUserID[<?php echo $i ?>]" value="<?php echo $teacher['usr_id'] ?>">

        <div id="wrapper">
            <div class="wrapper2">
                <select name="session1[<?php echo $i ?>]" class="s1_select">
                    <option value="null"></option>
                    <?php foreach ($session1 as $pres) { ?>
                        <?php echo $teacher['ses_1_pres_id'] ?> <BR>
                        <?php echo $pres['pres_id'] ?> <BR>

                        <option value="<?php echo $pres['pres_id'] ?>"
                                <?php if ($teacher['ses_1_pres_id'] == $pres['pres_id']) { ?>selected="selected"<?php } ?>><?php echo $pres['wkshp_nme'] ?>
                            (<?php echo $pres['rm_nbr'] ?>)
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="wrapper3">
                <select name="session2[<?php echo $i ?>]" class="s2_select">
                    <option value="null"></option>
                    <?php foreach ($session2 as $pres) { ?>
                        <option value="<?php echo $pres['pres_id'] ?>"
                                <?php if ($teacher['ses_2_pres_id'] == $pres['pres_id']) { ?>selected="selected"<?php } ?>><?php echo $pres['wkshp_nme'] ?>
                            (<?php echo $pres['rm_nbr'] ?>)
                        </option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>

    <?php $i = $i + 1; ?>

    <?php } ?>
    </div>
</form>
</body>
</html>
