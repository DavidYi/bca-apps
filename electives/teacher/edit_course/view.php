<html lang="en">
<head>
    <link rel="stylesheet" href="../teacher_add_course/view.css" type="text/css" />
</head>
<body>

    <div id="box">
        <p class="title">Edit Course</p>
        <form action="." method="post">
            <input type="hidden" name="action" value="edit_course">
            <input type="hidden" name="course_id" value="<?php echo $course_id; ?>"
            <label class="spacing">
                <span>Course Name</span>
                <input type="text" name="new_course_name" value="<?php echo $course_name ?>">
            </label>

            <label class="spacing">
                <span>Description</span>
                <textarea name="new_course_desc"><?php echo $course_desc ?></textarea>
            </label>

            <button class="submit s" type="submit" name="choice" value="Edit Course">Save</button>
            <button class="submit back" type="submit" name="choice" value="Back">Back</button>
        </form>
    </div>

</body>

</html>
