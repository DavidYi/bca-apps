<?php
//Okay idk where to put this thing so it's here for now

require("sendgrid-php/sendgrid-php.php");

$from = new SendGrid\Email(null, "celper19@bergen.org");
$subject = "Hello World from the SendGrid PHP Library!";
$to = new SendGrid\Email(null, "cel.peralta.jmj@gmail.com");
$content = new SendGrid\Content("text/plain", "It works?");
$mail = new SendGrid\Mail($from, $subject, $to, $content);

//Going to use getenv() later but for now hardcoding it
$apiKey = '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';
$sg = new \SendGrid($apiKey);

$response = $sg->client->mail()->send()->post($mail);
?>

<html>

<?php echo $response->statusCode(); ?> <br>
<?php echo $response->headers(); ?> <br>
<?php echo $response->body(); ?> <br>

<p>In the email include name of test signed up for, how many days away it is, and time and stuff.</p>


</html>