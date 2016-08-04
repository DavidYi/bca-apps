<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/<?php echo $app_url_path; ?>/../shared/signup_dates/styles2.css" rel="stylesheet" type="text/css" />
    <link href="/<?php echo $app_url_path; ?>/../shared/ss/main.css" rel="stylesheet" type="text/css" />

</head>
<body>
<form action="index.php" method="post">
    <input type="hidden" name="action" value="update_signup_dates">

    <div id="box">
        <h1 style="padding-top: 1em;">Signup Dates</h1>
        <div id="fixed_div">

            <div id="header_row">
                <label>
                    <h2 id="line" class="grade header">Grade</h2>
                </label>
                <label>
                    <h2 id="line" class="mode header">Description</h2>
                </label>
                <label id="role">
                    <h2 id="line" class="start2 header">Start</h2>
                </label>
                <label id="role">
                    <h2 id="line" class="end2 header">End</h2>
                </label>
            </div>
        </div>
        <div id="teacher_div">
            <?php $i = 0; ?>
            <?php foreach ($signups as $signup){ ?>

                <div class="row">
                    <input type="hidden" name="hdGrade[<?php echo $i ?>]" value="<?php echo $signup['grade_lvl'] ?>">
                    <input type="hidden" name="hdMode[<?php echo $i ?>]" value="<?php echo $signup['mode_cde'] ?>">

                    <label>
                        <h2 style="padding-right:4.3em;" id="line" class="grade"><?php echo $signup['grade_lvl'] ?></h2>
                    </label>
                    <label>
                        <h2 style="padding-right:2em;" id="line" class="mode"><?php echo $signup['mode_desc'] ?></h2>
                    </label>

                    <input id="line" type="text" class="start" name="start[<?php echo $i ?>]" value="<?php echo $signup['start']?>">
                    <input id="line" type="text" class="end" name="end[<?php echo $i ?>]" value="<?php echo $signup['end']?>">
                </div>

                <?php $i = $i + 1; ?>

            <?php } ?>
        </div>
        <div class="button-div">
            <button style="cursor: pointer" class="submit s" type="submit" name="choice" value="Update Dates">Submit</button>
            <button style="cursor: pointer" class="submit cancel" type="submit" name="choice" value="Back" formnovalidate>Cancel</button>
        </div>
    </div>
</form>
</div>
</body>
</html>


