<?php

function send_email($email_address, $test_name, $test_dt)
{

    require("sendgrid-php/sendgrid-php.php");

    $message = "Hello, you are scheduled to proctor for the following test: \nTest Name: " . $test_name . "\nTest Date: " . $test_dt;

    $from = new SendGrid\Email(null, "celper19@bergen.org");
    $subject = "Upcoming Tests";
    $to = new SendGrid\Email(null, $email_address);
    $content = new SendGrid\Content("text/plain", $message);
    $mail = new SendGrid\Mail($from, $subject, $to, $content);

//Going to use getenv() later but for now hardcoding it
    $apiKey = 'blank';
    $sg = new \SendGrid($apiKey);

    $response = $sg->client->mail()->send()->post($mail);
    echo $response->statusCode();
    echo $response->headers();
    echo $response->body();
    echo $message;
}

?>

<html>

<?php echo $response->statusCode(); ?> <br>
<?php echo $response->headers(); ?> <br>
<?php echo $response->body(); ?> <br>

<p>In the email include name of test signed up for, how many days away it is, and time and stuff.</p>


</html>