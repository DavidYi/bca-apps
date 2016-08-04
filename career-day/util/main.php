<?php
$app_cde = 'CAR';
$app_title = 'Career Day Registration';

// Provides environment specific configuration information.
include(__DIR__ . "/../../../config.php");

$app_url_path = $server_web_root . '/career-day';
$shared_ss_url = '/' .$server_web_root . '/shared/ss/main.css';

function goToLandingPage() {

    global $server_web_root;
    global $user;

    if ($user->getRole('CAR') == 'ADM') {
        header("Location: /" . $server_web_root . "/career-day/admin");
    } else {
        header("Location: /" . $server_web_root . "/career-day/admin");
    }
}

/* These includes depend on the variables above, therefore they should be at the end of the file. */
require_once(__DIR__ . "/../../shared/util/main.php");

?>