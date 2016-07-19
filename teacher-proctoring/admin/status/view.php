<html>
<head>
    <link rel="stylesheet" type='text/css' href="styles.css">
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,700' rel='stylesheet' type='text/css'>
</head>

<body>

<div id="content">

    <table id="ts">
        <tr>
            <th>Last</th>
            <th>First</th>
            <th>Hours</th>
        </tr>
        <?php foreach ($teacher_status_list as $teacher) :
            $teacher_last_name = $teacher['usrLast'];
            $teacher_first_name = $teacher['usrFirst'];
            $teacher_hours = $teacher['usrHours'];

        ?>

        <tr>
            <td> <?php echo $teacher_last_name; ?> </td>
            <td> <?php echo $teacher_first_name; ?> </td>
            <td> <?php echo $teacher_hours; ?> </td>
        </tr>

        <?php endforeach; ?>

    </table>


</div>

</body>
</html>