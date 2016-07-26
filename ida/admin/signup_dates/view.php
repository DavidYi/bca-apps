<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="view.css" rel="stylesheet" type="text/css" />
    <link href="../../../shared/ss/main.css" rel="stylesheet" type="text/css" />

</head>
<body>
<form action="index.php" method="post">
    <input type="hidden" name="action" value="modify_dates">

    <div id="box">
        <div id="wrapper">
            <div id ="columns">
                <h1 class="title">Modify Signup Dates</h1>

                <div id ="grades">
                <h2>Grade</h2>
                <h2 class="grade">9</h2>
                <h2 class="grade">10</h2>
                <h2 class="grade">11</h2>
                <h2 class="grade">12</h2>
            </div>

            <div id="se-wrap">
                <div id ="start">
                    <h2>Start</h2>
                    <input type="text" name="start_9" value="<?php echo $grade9['start']?>">
                    <input type="text" name="start_10" value="<?php echo $grade10['start']?>">
                    <input type="text" name="start_11" value="<?php echo $grade11['start']?>">
                    <input type="text" name="start_12" value="<?php echo $grade12['start']?>">
                </div>

                <div id ="end">
                    <h2>End</h2>
                    <input type="text" name="end_9" value="<?php echo $grade9['end']?>">
                    <input type="text" name="end_10" value="<?php echo $grade10['end']?>">
                    <input type="text" name="end_11" value="<?php echo $grade11['end']?>">
                    <input type="text" name="end_12" value="<?php echo $grade12['end']?>">
                </div>
                <div id="button-div">
                    <button class="submit s" type="submit" name="choice" value="Modify Dates">Submit</button>
                    <button class="submit cancel" type="submit" name="choice" value="Back">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</form>
</body>
</html>
