<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="view.css" rel="stylesheet" type="text/css" />

</head>
<body>
<?php
    $grade9 = get_signup_dates_by_grade(9);
    $grade10 = get_signup_dates_by_grade(10);
    $grade11 = get_signup_dates_by_grade(11);
    $grade12 = get_signup_dates_by_grade(12);
?>
<form action="index.php" method="post">
    <input type="hidden" name="action" value="modify_dates">

    <div id="box">
        <p class="title">Modify Signup Dates</p>

        <div id="header_row">
            <label>
                <span>Grade</span>
            </label>
            <label id="start">
                <span>Start</span>
            </label>
            <label id="end">
                <span>End</span>
            </label>
        </div>

        <div class="grade">
            <label>
                <span>9</span>
            </label>
            <input type="text" name="start_9" value="<?php echo $grade9['start']?>">
            <input type="text" name="end_9" value="<?php echo $grade9['end']?>">
        </div>

        <div class="grade">
            <label>
                <span>10</span>
            </label>
            <input type="text" name="start_10" value="<?php echo $grade10['start']?>">
            <input type="text" name="end_10" value="<?php echo $grade10['end']?>">
        </div>

        <div class="grade">
            <label>
                <span>11</span>
            </label>
            <input type="text" name="start_11" value="<?php echo $grade11['start']?>">
            <input type="text" name="end_11" value="<?php echo $grade11['end']?>">
        </div>

        <div class="grade">
            <label>
                <span>12</span>
            </label>
            <input type="text" name="start_12" value="<?php echo $grade12['start']?>">
            <input type="text" name="end_12" value="<?php echo $grade12['end']?>">
        </div>



        <button class="submit s" type="submit" name="choice" value="Modify Dates">Submit</button>
        <button class="submit cancel" type="submit" name="choice" value="Back">Cancel</button>
</form>
</div>
</body>
</html>
