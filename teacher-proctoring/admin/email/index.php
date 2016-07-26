<?php
require_once("../../util/main.php");
require_once("../../model/teacher_db.php");

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'list_upcoming_tests';
    }
}
switch ($action) {

    case 'list_upcoming_tests':
        $upcoming_tests = list_upcoming_tests();
        include("view.php");
        break;

    default:
        echo('Unknown account action: ' . $action);
        break;

}

function send_email($email_address, $test_name, $test_dt)
{

    require("sendgrid-php/sendgrid-php.php");

    $emails_sent = 0;

    $message = "Hello, you are scheduled to proctor for the following test:";
    $message .= "\nTest Name: " . $test_name;
    $message .= "\nTest Date: " . $test_dt;

    $from = new SendGrid\Email(null, "celper19@bergen.org");
    $subject = "Upcoming Test";
    $to = new SendGrid\Email(null, $email_address);
    $content = new SendGrid\Content("text/plain", $message);
    $mail = new SendGrid\Mail($from, $subject, $to, $content);

//Going to use getenv() later but for now hardcoding it
    $apiKey = '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';
    $sg = new \SendGrid($apiKey);

    $response = $sg->client->mail()->send()->post($mail);

    if ($response->statusCode() == 202) {
        $emails_sent += 1;
    } else {
        echo $response->statusCode();
        echo $response->headers();
        echo $response->body();
    }
}


?>
