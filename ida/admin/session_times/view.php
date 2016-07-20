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
    <input type="hidden" name="action" value="modify_times">

    <div id="box">
        <p class="title">Modify Session Times</p>

        <div id="header_row">
            <label>
                <span>Session</span>
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
                <span>1</span>
            </label>
            <input type="text" name="start1" value="<?php echo $session1['ses_start_time']?>">
            <input type="text" name="end1" value="<?php echo $session1['ses_end_time']?>">
        </div>

        <div class="grade">
            <label>
                <span>2</span>
            </label>
            <input type="text" name="start2" value="<?php echo $session2['ses_start_time']?>">
            <input type="text" name="end2" value="<?php echo $session2['ses_end_time']?>">
        </div>


        <button class="submit s" type="submit" name="choice" value="Modify">Submit</button>
        <button class="submit cancel" type="submit" name="choice" value="Back">Cancel</button>
</form>
</div>
</body>
</html>
