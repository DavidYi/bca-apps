<?php

?>
<html>
<head>
    <link rel="stylesheet" href="/../../../shared/ss/main.css">
<!--    <link rel="stylesheet" href="styles.css">-->
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
            //random
            document.body.appendChild(form);
            form.submit();
        }</script>
</head>
<body>
<div id="centerthis">
    <h2>Data Clearing</h2>
    <p>Warning: This Is Irreversible</p>
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
</div>
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
<script type="text/javascript">
    function toggleTable(str) {
        $(str).toggle();
        $(str).siblings(str).toggle();
    }
</script>
</body>