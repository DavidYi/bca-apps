<?php


?>

<html>
<head>
    <link rel="stylesheet" href="styles.css">
    <script type="text/javascript">function post(path, params, method) { //sends a post request; used to avoid having to use get to change the url since that looks sloppy and i don't want to bother with an inline form, especially if i want the confirmation prompt
            method = method || "post"; //also ripped straight off stackoverflow
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
<div id="content">
    <table>
        <tr>
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
                <!--TODO: List students on click, write query for it gg-->
                <td><a class="info" style="float: left; position: relative; color: #555555;"
                       onclick="popup('#B<?php echo $course_id ?>,#P<?php echo $course_id ?>')">✚&nbsp;&nbsp;</a> <?php echo $students; ?>
                    <div class="popup-bg" id="B<?php echo $course_id ?>" style="display: none;
  opacity: 0.7;
  background: #000;
  width: 100%;
  height: 100%;
  z-index: 10;
  top: 0;
  left: 0;
  position: fixed;">
                    </div>
                    <div class="popup" id="P<?php echo $course_id ?>">
                        <div class="entpop">
                            <div class="close">
                                <div class="x"
                                "=""><a href="#"
                                        style="color:#f0c30f; text-decoration: none; float: right; text-align: right;"
                                        onclick="cpopup('#B<?php echo $course_id ?>,#P<?php echo $course_id ?>')">✖</a>
                                <div class="presname" style="'text-align: left;"> <?php echo $course_name; ?></div>
                            </div>

                        </div>
                        <div class="popup-c">
                            <table id="ts">
                                <tr>
                                    <th>Last Name</th>
                                    <th>First Name</th>
                                    <th>Grade</th>
                                </tr>
                                <?php
                                $student_list = get_best_course_availability_students($course_id, $time_id);
                                foreach ($student_list as $student) :
                                    //Excellent naming choice
                                    $std_last = $student['usr_last_name'];
                                    $std_first = $student['usr_first_name'];
                                    $std_grade = $student['usr_grade_lvl']; ?>
                                    <tr>
                                        <td> <?php echo $std_last; ?> </td>
                                        <td> <?php echo $std_first; ?> </td>
                                        <td><?php echo $std_grade; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<center>
    <a href="index.php?action=availability_matrix_download">Availability List</a><br>
    <a href="index.php?action=electives_list_download">Electives List</a><br>
    <a href="index.php?action=availability_list_download">Teacher Availability List</a><br>
    <a href="index.php?action=course_interest_download">Course Interest List</a>
</center>
<ul>
    <li>
        <button onclick="clearStudentAvailability()">Clear Student Availability</button>
    </li>
    <li>
        <button onclick="clearStudentCourseInterest()">Clear Student Course Interest</button>
    </li>
    <li>
        <button onclick="clearTeacherAvailability()">Clear Teacher Availability</button>
    </li>
    <li>
        <button onclick="clearAllCourses()">Clear All Courses</button>
    </li>
</ul>
<script type="text/javascript" src="../../js/popup.js"></script>
<script type="text/javascript" src="../../js/cpopup.js"></script>
<script type="text/javascript" src="../../js/jquery.min.js"></script>
<script type="text/javascript" src="../../js/jquery.easing.min.js"></script>
<script type="text/javascript" src="../../js/jquery.plusanchor.min.js"></script>
<script type="text/javascript">
    function clearStudentAvailability() {
        if (confirm("Are you sure you want to clear student availability?")) {
            window.parent.location.href = 'index.php?action=clear_student_availability';
        }
    }</script>
<script type="text/javascript">
    function clearStudentCourseInterest() {
        if (confirm("Are you sure you want to clear student course interest?")) {
            window.parent.location.href = 'index.php?action=clear_student_interest';
        }
    }</script>
<script type="text/javascript">
    function clearTeacherAvailability() {
        if (confirm("Are you sure you want to clear teacher availability?")) {
            window.parent.location.href = 'index.php?action=clear_teacher_availability';
        }
    }</script>
<script type="text/javascript">
    function clearAllCourses() {
        if (confirm("Are you sure you want to clear all courses?")) {
            window.parent.location.href = 'index.php?action=clear_all_courses';
        }
    }</script>
</body>
</html>