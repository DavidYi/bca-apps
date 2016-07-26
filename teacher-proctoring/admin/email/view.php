<?php
/* TODO:
* Send an email within x days from test
* Ok so gotta get the date of the test
* And gotta compare it with current day
* And allow admin to change when emails are sent
* Kill me
*/
?>

<html>
<head>
    <link rel="stylesheet" type='text/css' href="style.css">
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,700' rel='stylesheet' type='text/css'>
</head>

<body>
<table id="ts">
    <tr>
        <th>Test ID</th>
        <th>Test Name</th>
        <th>Test Date</th>
        <th>Days Away</th>
    </tr>

    <?php foreach ($upcoming_tests as $test) :
        $test_id = $test['test_id'];
        $test_name = $test['test_name'];
        $test_dt = $test['test_dt'];
        $test_days_away = $test['difference'];
        ?>


        <tr>
            <td> <?php echo $test_id; ?> </td>
            <td> <?php echo $test_name; ?> </td>
            <td> <?php echo $test_dt; ?> </td>
            <td> <?php echo $test_days_away; ?> </td>
        </tr>
    <?php endforeach; ?>
</table>

<h1>Put some weird scheduling thing here.</h1>

</body>
</html>