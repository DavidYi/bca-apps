<?php
$app_cde = 'FTR';
$app_title = 'Field Trips';

// Provides environment specific configuration information.
include(__DIR__ . "/../../../config.php");

$app_url_path = $server_web_root . '/field-trip';
$shared_ss_url = '/' .$server_web_root . '/shared/ss/main.css';


function goToLandingPage() {

    global $server_web_root;
    global $user;

    if ($user->getRole('FTR') == 'ADM') {
        header("Location: /" . $server_web_root . "/field-trip/admin");
    } elseif ($user->usr_type_cde == 'TCH'){
        header("Location: /" . $server_web_root . "/field-trip/teacher");
    } else {
        header("Location: /" . $server_web_root . "/field-trip/student");
    }
}

/* These includes depend on the variables above, therefore they should be at the end of the file. */
require_once(__DIR__ . "/../../shared/util/main.php");

?>