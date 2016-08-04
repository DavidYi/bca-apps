<?php
$app_cde = 'OELE';
$app_title = 'Off-hour Elective Registration';

// Provides environment specific configuration information.
include(__DIR__ . "/../../../config.php");

$app_url_path = $server_web_root . '/electives';
$shared_ss_url = '/' .$server_web_root . '/shared/ss/main.css';


function goToLandingPage() {

    global $server_web_root;
    global $user;

    if ($user->getRole('OELE') == 'ADM') {
        header("Location: /" . $server_web_root . "/electives/admin");
    } elseif ($user->usr_type_cde == 'TCH'){
        header("Location: /" . $server_web_root . "/electives/teacher");
    } else {
        header("Location: /" . $server_web_root . "/electives/student");
    }
}

/* These includes depend on the variables above, therefore they should be at the end of the file. */
require_once(__DIR__ . "/../../shared/util/main.php");

?>