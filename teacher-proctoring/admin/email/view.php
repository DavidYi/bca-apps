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
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
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
            <td>
                <form method="post">
                    <button type="submit" value="Mail" name="mail"><i class="fa fa-envelope" aria-hidden="true"></i>
                    </button> <!-- assign a name for the button -->
                </form>
            </td>
        </tr>

    <?php endforeach; ?>
</table>
<form method="post" class="email-all">
    <button type="submit" value="Mail All" name="mail-all">Mail All</button> <!-- assign a name for the button -->
</form>
<?php

if (isset($_POST['mail'])) {
    send_email('celper19@bergen.org', $test_name, $test_dt);
    header("Location: ../../admin/email/");

    echo 'Email sent.';
}

if (isset($_POST['mail-all'])) {

    foreach ($upcoming_tests as $test) :
        if ($test['difference'] <= 7) {
            send_email('celper19@bergen.org', $test_name, $test_dt);
        }
    endforeach;

    echo 'Emails sent.';
    header("Location: ../../admin/email/");
}

?>

</body>
</html>