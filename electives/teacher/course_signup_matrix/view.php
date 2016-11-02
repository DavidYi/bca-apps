<html>
<head>
    <link rel="stylesheet" href="../../ss/main.css">
    <link rel="stylesheet" href="./index.css">
    <script src="../../js/jquery.min.js"></script>


</head>
<body style="padding-top:3%">

<header>
    <h1 class="title">Course Student Matrix</h1>
    <a href="#" onclick="history.back();"><button id="return_home" class="b">Back</button></a>
</header>

<div class="centerthis">
    <h2><?php echo ($course['course_name']) ?> (<?php echo ($course['name']) ?>)
    </h2>
    <br>
    <br>

    <?php
        $row1 = '';
        $row2 = '';

        foreach ($header_array as $row) {
            $row1 .= "<th>" . $row['time_short_desc'] . "</th>";
            $row2 .= "<th>" . $row['cnt'] . "</th>";
        }
    ?>


    <table class="table-fill">
        <thead id="days">
            <tr><th>Mods</th><?php echo $row1; ?></tr>
            <tr><th># Students</th><?php echo $row2; ?></tr>
        </thead>
        <tbody class="table-hover">
        <?php
            $rownum = 0;
            $lastStudentId = -1;
            foreach ($body_array as $row) {
                if ($lastStudentId !== $row['usr_id']) {
                    if ($lastStudentId !== -1) {
                        echo ("</tr>");
                    }
                    $lastStudentId = $row['usr_id'];
                    $rownum++;

                    if ($rownum % 2 == 0) {
                    } else {
                        echo "<tr class='odd'>";
                    }
                    echo ("<td class='student-name'>" . $row['usr_last_name'] . ', ' . $row['usr_first_name'] . "</td>");
                }
                echo ("<td>" . $row['mark'] . "</td>");
            }
            echo "</tr>";
        ?>
        </tbody>
    </table>

</body>

</html>