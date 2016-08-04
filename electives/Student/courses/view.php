<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Table Style</title>
<!--    <meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; width=device-width;">-->
    <link rel="stylesheet" href="index.css">
    <script src="../../js/jquery.min.js"></script>



</head>

<body>

<form action="." method="POST">
    <input type="hidden" name="action" value="update_courses">

    <div class="table-title">
        <button class="submit back" onclick="location.href = '../index.php'">Back</button>
        <h3>Course Interests</h3>
        <button class="submit" type="submit">Submit</button>
    </div>

    <table class="table-fill">
        <thead>
            <tr id="head_row">
                <th class="text-left nav"><a href="index.php?action=sort_courses&sort=1&order=<?php if 
                    ($sort_order == 1 && $sort_by == 1) { echo 2; } else { echo 1; } ?>">Elective</a></th>
                <th class="text-left nav"><a href="index.php?action=sort_courses&sort=2&order=<?php if
                    ($sort_order == 1 && $sort_by == 2) { echo 2; } else { echo 1; } ?>">Teacher</a></th>
                <th class="text-left nav" id="navdescription">Description</th>
                <th class="text-left nav" id="navinterest"><a href="index.php?action=sort_courses&sort=3&order=<?php if
                    ($sort_order == 2 && $sort_by == 3) { echo 1; } else { echo 2; } ?>">Express Interest</a></th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($courseList as $course) :?>
                <tr>
                    <td class="text-left"><label><?php echo $course['course_name']?></label></td>
                    <td class="text-left"><label><?php echo $course['teacher']?></label></td>
                    <td class="text-left" id="description"><label><?php echo $course['course_desc']?></label></td>
                    <td class="text-left" id="interest">
                        <label class="switch">
                            <?php
                            if ($course["enrolled"] == 1) {
                                echo "<input type='checkbox' value=" . $course['course_id'] . " name='checkbox[]' checked>";
                            } else {
                                echo "<input type='checkbox' value=" . $course['course_id'] . " name='checkbox[]'>";
                            }
                            ?>

                            <div class="slider round"></div>
                        </label>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</form>
</body>

<script>

    function submit_courses(){

        var ids = $("input:checkbox[name='checkbox[]']:checked").map(function(index) {
            return this.id;
        });
        var index;

        for (index = 0; index < ids.length; ++index) {
            document.write(ids[index]);
        }

    }
    
</script>
</html>