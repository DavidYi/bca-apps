<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Table Style</title>
    <meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; width=device-width;">
    <link rel="stylesheet" href="index.css">
</head>

<body>
<div class="table-title">
    <h3>Course Interests</h3>
</div>

<form action="." method="POST">
    <table class="table-fill">
        <thead>
        <tr>
            <th class="text-left">Elective</th>
            <th class="text-left">Teacher</th>
            <th class="text-left">Description</th>
            <th class="text-left">Express Interest</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($courseList as $course) { ?>
        <tr>
            <td class="text-left"><label><?php echo $course['course_name']?></label></td>
            <td class="text-left"><label><?php echo $course['teacher']?></label></td>
            <td class="text-left"><label><?php echo $course['course_desc']?></label></td>
            <td class="text-left"><label><input type="checkbox" class="mods" name="time[]" value="Yes">Yes</label></td>
        </tr>
        <?php } ?>

        </tbody>
    </table>

    <div class="wrapper">
        <button class="submit" style="background-color:white;margin-left:auto;margin-right:auto;display:block;margin-top:10%;margin-bottom:0%" type="submit">Submit</button>
    </div>
</form>
</body>
</html>
