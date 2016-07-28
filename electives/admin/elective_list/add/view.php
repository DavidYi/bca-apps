<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../../../teacher/teacher_add_course/view.css" rel="stylesheet" type="text/css" />

</head>
<body>
<form action="index.php" method="post">
    <input type="hidden" name="action" value="add_course">

    <div id="box">
        <p class="title">Create Course</p>

        <label class="spacing">
            <span>Course Name</span>
            <input type="text" name="course_name">
        </label>

        <label class="spacing">
            <span>Description</span>
            <textarea name="course_desc"></textarea>
        </label>

        <label class="spacing">
            <span>Teacher</span>
            <select id="teacher" name="teacher">
                <option value="none">-- Choose Teacher --</option>
                <?php foreach($teacher_list as $teacher) :
                    $name = $teacher['name'];
                    $id = $teacher['usr_id']?>
                    <option value=<?php echo $id; ?>><?php echo $name; ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        
        <button class="submit s" type="submit" name="choice" value="Add Course">Submit</button>
        <button class="submit back" type="submit" name="choice" value="Back">Back</button>
</form>
</div>
</body>
</html>
