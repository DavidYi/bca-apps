<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="view.css<?php echo(getVersionString()); ?>" rel="stylesheet" type="text/css" />
    <link href="../../../shared/ss/main.css<?php echo(getVersionString()); ?>" rel="stylesheet" type="text/css" />

</head>
<body>
<form action="index.php" method="post">
    <input type="hidden" name="action" value="modify_times">

    <div id="box">
        <div id="wrapper">
            <div id="columns">
                <h1 class="title">Modify Session Times</h1>

                <div id="sessions">
                    <h2>Session</h2>
                    <h2 class="session">1</h2>
                    <h2 class="session">2</h2>
                </div>

                <div id="se-wrap">
                    <div id="start">
                        <h2>Start</h2>
                        <input type="text" name="start1" value="<?php echo $session1['ses_start_time']?>">
                        <input type="text" name="start2" value="<?php echo $session2['ses_start_time']?>">
                    </div>

                    <div id="end">
                        <h2>End</h2>
                        <input type="text" name="end1" value="<?php echo $session1['ses_end_time']?>">
                        <input type="text" name="end2" value="<?php echo $session2['ses_end_time']?>">
                    </div>
                </div>

                <div id="button-div">
                    <button style="cursor: pointer" class="submit s" type="submit" name="choice" value="Modify">Submit</button>
                    <button style="cursor: pointer" class="submit b" type="submit" name="choice" value="Back">Back</button>
                </div>
            </div>
        </div>
    </div>
</form>
</body>
</html>
