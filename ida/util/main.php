<?php

$app_cde = 'IDA';
$app_title = 'IDA Registration';

// Provides environment specific configuration information.
include(__DIR__ . "/../../../config.php");

$shared_ss_url = '/' . $server_web_root . '/shared/ss/main.css';
$app_url_path = $server_web_root . '/ida';


function goToLandingPage()
{
    global $server_web_root;

    global $user;

    if ($user->getRole('IDA') == 'ADM') {
        header("Location: /" . $server_web_root . "/ida/admin/");
    } else {
        header("Location: /" . $server_web_root . "/ida/itinerary/");

    }
}

/* These includes depend on the variables above, therefore they should be at the end of the file. */
require_once(__DIR__ . "/../../shared/util/main.php");

?>