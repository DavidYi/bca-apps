<?php


?>

<html>
<head>
    <link rel="stylesheet" href="styles.css">
    <script type="text/javascript">function post(path, params, method) { //sends a post request; used to avoid having to use get to change the url since that looks sloppy and i don't want to bother with an inline form, especially if i want the confirmation prompt
            method = method || "post";
            var form = document.createElement("form");
            form.setAttribute("method", method);
            form.setAttribute("action", path);

            for (var key in params) {
                if (params.hasOwnProperty(key)) {
                    var hiddenField = document.createElement("input");
                    hiddenField.setAttribute("type", "hidden");
                    hiddenField.setAttribute("name", key);
                    hiddenField.setAttribute("value", params[key]);

                    form.appendChild(hiddenField);
                }
            }
            document.body.appendChild(form);
            form.submit();
        }</script>
</head>
<body>
<h1>Electives Report</h1>
<a href="../index.php">
    <button
        type="submit" id="return_button" name="return_button">Return to Admin Panel
    </button>
</a>
<div id="content">
    <center>
    <table>
        <tr class="columns">
            <th>Course Name</th>
            <th>Time</th>
            <th>Available Students</th>
        </tr>
        <?php foreach ($availability_list as $course) :
            $course_id = $course['course_id'];
            $course_name = $course['course_name'];
            $times = $course['time_short_desc'];
            $time_id = $course['time_id'];
            $students = $course['students'];

            ?>
            <tr>
                <td> <?php echo $course_name; ?> </td>
                <td> <?php echo $times; ?> </td>
                <td><a class="info" onclick="toggleTable('#P<?php echo $course_id; ?><?php echo $time_id ?>')"
                       style="float: left; position: relative; color: #555555;"
                    >✚&nbsp;&nbsp;</a> <?php echo $students; ?>
                </td>
            </tr>

            <tr class="student-table columns" id="P<?php echo $course_id; ?><?php echo $time_id ?>" style="background-color: black;">
                <th>Last Name</th>
                <th>First Name</th>
                <th>Grade</th>
            </tr>
            <?php
            $student_list = get_best_course_availability_students($course_id, $time_id);
            foreach ($student_list as $student) :
                $std_last = $student['usr_last_name'];
                $std_first = $student['usr_first_name'];
                $std_grade = $student['usr_grade_lvl']; ?>
                <tr class="student-table" id="P<?php echo $course_id; ?><?php echo $time_id ?>">
                    <td> <?php echo $std_last; ?> </td>
                    <td> <?php echo $std_first; ?> </td>
                    <td><?php echo $std_grade; ?></td>
                </tr>
            <?php endforeach; ?>

        <?php endforeach; ?>
    </table>
    </center>
</div>
</body>
</html>
