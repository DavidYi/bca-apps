<html lang="en">
<body>
    <h1>Edit Course</h1>
    <form action="." method="post">
        <input type="hidden" name="action" value="edit_course">
        Course Name: <input type="text" name="new_course_name" value="<?php echo $course_name ?>"><br><br>
        Course Description: <input type="text" name="new_course_desc" value="<?php echo $course_desc ?>"><br><br>
        <input type="hidden" name="course_id" value="<?php echo $course_id ?>">
        <button type="submit" name="choice" value="Edit Course">Save</button>
        <button type="submit" name="choice" value="Back">Back</button>
    </form>
</body>

</html>
