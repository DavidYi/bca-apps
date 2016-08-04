<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/<?php echo $app_url_path ?>/../shared/signup_dates/view.css" rel="stylesheet" type="text/css" />
    <link href="../../../shared/ss/main.css" rel="stylesheet" type="text/css" />

</head>
<body>
<form action="index.php" method="post">
    <input type="hidden" name="action" value="modify_dates">

    <div id="box">
        <div id="wrapper">
            <h1 class="title">Modify Signup Dates</h1>
            <div id ="columns">


                <div id ="grades">
                    <div style="padding-bottom:1.2em;"></div>
                    <?php foreach ($signups as $signup){ ?>
                        <h2><?php echo($signup['grade_lvl']); ?></h2>
                    <?php } ?>
                </div>
                <div id ="grades">
                    <div style="padding-bottom:1.2em;"></div>
                    <?php foreach ($signups as $signup){ ?>
                        <h2><?php echo($signup['mode_desc']); ?></h2>
                    <?php } ?>
                </div>
            </div>

            <div id="se-wrap">
                <div id ="start">
                    <h2><strong>Start</strong></h2>
                    <?php foreach ($signups as $signup){ ?>
                        <input type="text" name="start" value="<?php echo $signup['start']?>">
                    <?php } ?>
                </div>

                <div id ="end">
                    <h2><strong>End</strong></h2>
                    <?php foreach ($signups as $signup){ ?>
                        <input type="text" name="end" value="<?php echo $signup['end']?>">
                    <?php } ?>
                </div>
                <div id="button-div">
                    <button style="cursor: pointer" class="submit s" type="submit" name="choice" value="Modify Dates">Submit</button>
                    <button style="cursor: pointer" class="submit cancel" type="submit" name="choice" value="Back">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</form>
</body>
</html>
