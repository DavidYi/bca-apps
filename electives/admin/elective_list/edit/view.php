<html lang="en">
<head>
    <link rel="stylesheet" href="../../../teacher/teacher_add_course/view.css" type="text/css" />
</head>
<body>

<div id="box">
    <p class="title">Edit Course</p>
    <form action="." method="post">
        <input type="hidden" name="action" value="edit">
        <input type="hidden" name="course_id" value="<?php echo $course_id; ?>"
        <label class="spacing">
            <span>Course Name</span>
            <input type="text" name="name" value="<?php echo $course_name; ?>">
        </label>

        <label class="spacing">
            <span>Description</span>
            <textarea name="desc"><?php echo $course_desc ?></textarea>
        </label>

        <label class="spacing">
            <span>Teacher</span>
            <select id="teacher" name="teacher">
                <?php
                $i;
                for ($i = 0; $i < sizeof($teacher_list); $i++) {
                    $id = $teacher_list[$i]['usr_id'];
                    $name = $teacher_list[$i]['name'];
                    if ($teacher_id == $id) {
                        echo "<option selected='selected' value=" . $id . ">" . $name . "</option>";
                    } else {
                        echo "<option value=" . $id . ">" . $name . "</option>";
                    }
                }
                ?>
            </select>
        </label>

        <button class="submit s" type="submit" name="choice" value="Edit Course">Save</button>
        <button class="submit back" onclick="location.href='../index.php'" name="choice" value="Back">Back</button>

    </form>
</div>

</body>

</html>
