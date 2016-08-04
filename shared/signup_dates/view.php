<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/<?php echo $app_url_path; ?>/../shared/signup_dates/view.css" rel="stylesheet" type="text/css" />

</head>
<body>
<form action="index.php" method="post">
    <input type="hidden" name="action" value="update_signup_dates">

    <div id="box">
        <div id="fixed_div">
            <button style="cursor: pointer" class="submit s" type="submit" name="choice" value="Update Dates">Submit</button>
            <p class="title">Modify Signup Dates</p>
            <button style="cursor: pointer" class="submit back" type="submit" name="choice" value="Back">Back</button>

            <div id="header_row">
                <label>
                    <span class="grade header"><strong>Grade</strong></span>
                </label>
                <label>
                    <span class="mode header"><strong>Description</strong></span>
                </label>
                <label id="role">
                    <span class="start header"><strong>Start</strong></span>
                </label>
                <label id="role">
                    <span class="end header"><strong>End</strong></span>
                </label>
            </div>
        </div>
        <div id="teacher_div">
            <?php $i = 0; ?>
            <?php foreach ($signups as $signup){ ?>

                <div class="row <?php if($i % 2 == 1) { ?>odd<?php } ?>">
                    <input type="hidden" name="hdGrade[<?php echo $i ?>]" value="<?php echo $signup['grade_lvl'] ?>">
                    <input type="hidden" name="hdMode[<?php echo $i ?>]" value="<?php echo $signup['mode_cde'] ?>">

                    <label>
                        <span class="grade"><?php echo $signup['grade_lvl'] ?></span>
                    </label>
                    <label>
                        <span class="mode"><?php echo $signup['mode_desc'] ?></span>
                    </label>

                    <input type="text" class="start" name="start[<?php echo $i ?>]" value="<?php echo $signup['start']?>">
                    <input type="text" class="end" name="end[<?php echo $i ?>]" value="<?php echo $signup['end']?>">
                </div>

                <?php $i = $i + 1; ?>

            <?php } ?>
        </div>
    </div>
</form>
</div>
</body>
</html>


