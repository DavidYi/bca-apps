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

    case 'send_email':


        $list = array('celper19@bergen.org', 'cel.peralta.jmj@gmail.com');

        $email_address = 'celper19@bergen.org'; //Change to array of addresses of teachers proctoring test
        $test_id = strtolower(filter_input(INPUT_GET, 'test_id'));
        $test_name = (filter_input(INPUT_GET, 'test_name'));
        $test_dt = (filter_input(INPUT_GET, 'test_dt'));

        require("sendgrid-php/sendgrid-php.php");
        //          $apiKey = getenv('SENDGRID_API_KEY');
        $apiKey = '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';
        $sg = new \SendGrid($apiKey);


        $message = "Hello, you are scheduled to proctor for the following test:";
        $message .= "\nTest Name: " . $test_name;
        $message .= "\nTest Date: " . $test_dt;

        $from = new SendGrid\Email(null, "celper19@bergen.org");
        $subject = "Upcoming Test: " . $test_name;
        $to = new SendGrid\Email(null, $email_address);
        new SendGrid\Email(null, 'cel.peralta.jmj@gmail.com');
        $content = new SendGrid\Content("text/plain", $message);
        $mail = new SendGrid\Mail($from, $subject, $to, $content);


        $request_body = json_decode('{
  "personalizations": [
    {
      "to": [
        {
          "email": "celper19@bergen.org",
          "email": "cel.peralta.jmj@gmail.com"
        }
      ],
      "subject": "Upcoming Test"
    }
  ],
  "from": {
    "email": "celper19@bergen.org"
  },
  "content": [
    {
      "type": "text/plain",
      "value": "Hello, Email!"
    }
  ]
}');

        $apiKey = getenv('SENDGRID_API_KEY');
        $sg = new \SendGrid($apiKey);

        $response = $sg->client->mail()->send()->post($request_body);
        echo $response->statusCode();
        echo $response->body();
        echo $response->headers();


        $response = $sg->client->mail()->send()->post($mail);

        if ($response->statusCode() == 202) {
            update_reminder_sent($test_id);
            $action = null;
            header("Location: ../../admin/email/");
            echo $test_id;
            echo $test_name;
        } else {
            echo $response->statusCode();
            echo $response->headers();
            echo $response->body();
        }
        include("view.php");
        break;

    case 'send_email_all':
        $upcoming_tests = list_upcoming_tests();
        foreach ($upcoming_tests as $test) :
            if ($test['difference'] <= 7 and $test['reminder_sent_dt'] == null) {

                $list = array('celper19@bergen.org', 'cel.peralta.jmj@gmail.com');

                $email_address = $list; //Change to array of addresses of teachers proctoring test
                $test_id = $test['test_id'];
                $test_name = $test['test_name'];
                $test_dt = $test['test_dt'];
                $test_days_away = $test['difference'];

                require("sendgrid-php/sendgrid-php.php");


                $message = "Hello, you are scheduled to proctor for the following test:";
                $message .= "\nTest Name: " . $test_name;
                $message .= "\nTest Date: " . $test_dt;

                $from = new SendGrid\Email(null, "celper19@bergen.org");
                $subject = "Upcoming Test";
                $to = new SendGrid\Email(null, $list);
                $content = new SendGrid\Content("text/plain", $message);
                $mail = new SendGrid\Mail($from, $subject, $to, $content);

//Going to use getenv() later but for now hardcoding it
                $apiKey = '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';
                $sg = new \SendGrid($apiKey);

                $response = $sg->client->mail()->send()->post($mail);

                if ($response->statusCode() == 202) {
                    update_reminder_sent($test_id);
                    $action = null;
                } else {
                    echo $response->statusCode();
                    echo $response->headers();
                    echo $response->body();
                }
            }
        endforeach;
        $action = 'list_upcoming_tests';
        include("view.php");
        break;


    default:
        echo('Unknown account action: ' . $action);
        break;

}

//function send_email($email_address, $test_id, $test_name, $test_dt)
//{
//
//
//}


?>
