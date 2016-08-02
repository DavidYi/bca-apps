<?php


?>

<html>
<head>
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

<table>
    <tr>
        <th>Course Name</th>
        <th>Times</th>
        <th>Available Students</th>
    </tr>
    <?php foreach ($availability_list as $course) :
        $course_name = $course['course_name'];
        $times = $course['time_short_desc'];
        $students = $course['students'];

    ?>
    <tr>
        <td> <?php echo $course_name; ?> </td>
        <td> <?php echo $times; ?> </td>
        <td> <?php echo $students; ?> </td>
    </tr>
    <?php endforeach; ?>
</table>

<a href="index.php?action=electives_list_download">Electives List</a><br>
<a href="index.php?action=availability_list_download">Availability List</a>
</body>
</html>
