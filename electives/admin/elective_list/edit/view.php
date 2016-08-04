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
            <input type="text" name="name" value="<?php echo $course_name; ?>" required>
        </label>

        <label class="spacing">
            <span>Description</span>
            <textarea name="desc" required><?php echo $course_desc ?></textarea>
        </label>

        <label class="spacing">
            <span>Teacher</span>
            <select id="teacher" name="teacher" required>
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

        <div class="button_wrapper">
            <button class="submit back" type="submit" name="choice" value="Back" formnovalidate>Back</button>
            <button class="submit s" type="submit" name="choice" value="Add Course">Submit</button>
        </div>


    </form>
</div>

</body>

</html>
