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
                    <button type="submit" value="Mail" name="submit"><i class="fa fa-envelope" aria-hidden="true"></i>
                    </button> <!-- assign a name for the button -->
                </form>
            </td>
        </tr>

    <?php endforeach; ?>
</table>
<?php function send_email($email_address, $test_name, $test_dt)
{

    require("sendgrid-php/sendgrid-php.php");

    $message = "Hello, you are scheduled to proctor for the following test:";
    $message .= "\nTest Name: " . $test_name;
    $message .= "\nTest Date: " . $test_dt;

    $from = new SendGrid\Email(null, "celper19@bergen.org");
    $subject = "Upcoming Tests";
    $to = new SendGrid\Email(null, $email_address);
    $content = new SendGrid\Content("text/plain", $message);
    $mail = new SendGrid\Mail($from, $subject, $to, $content);

//Going to use getenv() later but for now hardcoding it
    $apiKey = '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';
    $sg = new \SendGrid($apiKey);

    $response = $sg->client->mail()->send()->post($mail);

    if ($response->statusCode() == 202) {
        echo 'Email sent!';
    } else {
        echo $response->statusCode();
        echo $response->headers();
        echo $response->body();
    }
}

if (isset($_POST['submit'])) {
    send_email('cel.peralta.jmj@gmail.com', $test_name, $test_dt);
    header("Location: ../../admin/email/");
} ?>

</body>
</html>