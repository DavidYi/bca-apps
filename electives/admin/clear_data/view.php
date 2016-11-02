<?php

?>
<html>
<head>
    <link rel="stylesheet" href="/../../../bca-apps/shared/ss/main.css">
    <link rel="stylesheet" href="styles.css">
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
<a href="../index.php"><button>Return To Admin Panel</button></a>

<div id="centerthis">
    <h1 class="title">Data Clearing</h1>
    <h2>Use this page to clear user data on a periodic basis, see instructions below.</h2>
    <ul>
        <li>
            <button onclick="clearStudentAvailability()">Clear Student Availability</button>
            <p>Should be run every summer to clear student availability.</p>
        </li>
        <br>
        <li>
            <button onclick="clearStudentCourseInterest()">Clear Student Course Interest</button>
            <p>Should be run every trimester to clear the students interest.</p>
        </li>
        <br>
        <li>
            <button onclick="clearTeacherAvailability()">Clear Teacher Availability</button>
            <p>Should be run every summer to clear teacher availability.</p>
        </li>
        <br>
        <li>
            <button onclick="inactivateAllCourses()">Inactivate All Courses</button>
            <p>Should may be run over the summer. This inactivates ALL COURSES in the database.</p>
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
    function inactivateAllCourses() {
        if (confirm("Are you sure you want to inactivate all courses?")) {
            window.parent.location.href = 'index.php?action=inactivate_all_courses';
        }
    }</script>
</body>
</html>