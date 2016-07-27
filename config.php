<?php

//
// The root directory of the application from the web perspective.  (In production, the "bca-apps" level does not exist.)
//
$server_web_root = "bca-apps";

//
// Controls if errors display on the error page.  Should be off in production.
//
$debug_mode = true;

//
// Server containing the database
//
$db_host = "webdev01.bergen.org";

//
// Looks up the instance name for the database by application.
//
$db_name = "";
if ($app_cde == 'CAR')
    $db_name = 'atcsdevb_career_day';
else if ($app_cde == 'OELE')
    $db_name = 'atcsdevb_teacher_dashboard';
else if ($app_cde == 'IDA')
    $db_name = 'atcsdevb_ida';
else if ($app_cde == 'SENX')
    $db_name = 'atcsdevb_senexp';
else if ($app_cde == 'TPOR')
    $db_name = 'atcsdevb_teacher_dashboard';
else {
    echo "App code not defined in config.php.";
    exit();
}

//
// For now, all applications share one username/password.  If this changes, the usernames and passwords could be put
// in the cascading if statements above.
//
$username = 'atcsdevb_shrusr';
$password = 'EsM1)Q8?4hd~';

$dsn = 'mysql:host='. $db_host . ';dbname=' . $db_name;

$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

?>