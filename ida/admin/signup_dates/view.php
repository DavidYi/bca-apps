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
    <input type="hidden" name="action" value="modify_dates">

    <div id="box">
        <p class="title">Create Course</p>

<!--        <label class="spacing">-->
<!--            <span>Course Name</span>-->
<!--            <input type="text" name="class_name">-->
<!--        </label>-->
<!---->
<!---->
<!--        <label class="spacing">-->
<!--            <span>Description</span>-->
<!--            <textarea name="description"></textarea>-->
<!--        </label>-->

        <div id="header_row">
            <label>
                <span>Grade</span>
            </label>
            <label>
                <span>Start</span>
            </label>
            <label>
                <span>End</span>
            </label>
        </div>

        <div class="grade">
            <label>
                <span>9</span>
            </label>
            <input type="text" name="start_9">
            <input type="text" name="end_9">
        </div>

        <div class="grade">
            <label>
                <span>10</span>
            </label>
            <input type="text" name="start_10">
            <input type="text" name="end_10">
        </div>

        <div class="grade">
            <label>
                <span>11</span>
            </label>
            <input type="text" name="start_11">
            <input type="text" name="end_11">
        </div>

        <div class="grade">
            <label>
                <span>12</span>
            </label>
            <input type="text" name="start_12">
            <input type="text" name="end_12">
        </div>



        <button class="submit s" type="submit" name="choice" value="Modify Dates">Submit</button>
        <button class="submit cancel" type="submit" name="choice" value="Back">Cancel</button>
</form>
</div>
</body>
</html>
