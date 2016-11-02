<?php
require_once("../../util/main.php");
require_once("../../model/teacher_db.php");
include(__DIR__ . "../../../../config.php");

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

    case 'send_email':
        require("sendgrid-php/sendgrid-php.php");
        $apiKey = $SENDGRID_API_KEY;
        $sg = new \SendGrid($apiKey);

//        Get test info for email
        $test_id = strtolower(filter_input(INPUT_GET, 'test_id'));
        $test_name = (filter_input(INPUT_GET, 'test_name'));
        $test_dt = (filter_input(INPUT_GET, 'test_dt'));

//        Get teacher emails
        $teachers = get_upcoming_emails($test_id);

        $email_address = array('celper19@bergen.org', 'celinanperalta@gmail.com'); //Change to array of addresses of teachers proctoring test

        $message = "Hello, you are scheduled to proctor for the following test:";
        $message .= "\nTest Name: " . $test_name;
        $message .= "\nTest Date: " . $test_dt;

        $from = new SendGrid\Email(null, "celper19@bergen.org"); //Change to administrator email
        $subject = "Upcoming Test: " . $test_name;

        $content = new SendGrid\Content("text/plain", $message);

        // foreach($teachers as $teacher)
        foreach ($email_address as $email) {
            $to = new SendGrid\Email(null, $email);
            $mail = new SendGrid\Mail($from, $subject, $to, $content);
            $response = $sg->client->mail()->send()->post($mail);
        }

        update_reminder_sent($test_id);

        $action = null;
        header("Location: ../../admin/email/");
        include("view.php");
        break;

    case 'send_email_all':
        $upcoming_tests = list_upcoming_tests();
        foreach ($upcoming_tests as $test) :
            if (($test['difference'] === 7 or $test['difference'] === 1) and $test['reminder_sent_dt'] == null) {

                //official things
                require("sendgrid-php/sendgrid-php.php");
                $apiKey = $SENDGRID_API_KEY;
                $sg = new \SendGrid($apiKey);

                //        Get teacher emails
                $teachers = get_upcoming_emails($test_id);


                $email_address = array('celper19@bergen.org', 'celinanperalta@gmail.com'); //Change to array of addresses of teachers proctoring test
                $test_id = $test['test_id'];
                $test_name = $test['test_name'];
                $test_dt = $test['test_dt'];
                $test_days_away = $test['difference'];


                $message = "Hello, you are scheduled to proctor for the following test:";
                $message .= "\nTest Name: " . $test_name;
                $message .= "\nTest Date: " . $test_dt;

                $from = new SendGrid\Email(null, "celper19@bergen.org"); //Change to administrator email
                $subject = "Upcoming Test";

                $content = new SendGrid\Content("text/plain", $message);

                foreach ($email_address as $email) {
                    $to = new SendGrid\Email(null, $list);
                    $mail = new SendGrid\Mail($from, $subject, $to, $content);
                    $response = $sg->client->mail()->send()->post($mail);
                }

                update_reminder_sent($test_id);
            }
        endforeach;
        $action = 'list_upcoming_tests';
        include("view.php");
        break;


    default:
        echo('Unknown account action: ' . $action);
        break;

}

?>
