<?php
//
// Common imports that should be available on all pages.
// Add them here.
//
$app_cde = 'SENX';
$app_title = 'Senior Expositions';

include(__DIR__ . "/../../config.php");

$shared_ss_url = '/' . $server_web_root . '/shared/ss/main.css';
$app_url_path = $server_web_root . '/senior-experience';    // Name of the app on the web server.  Change this if the directory changes.

// Provides environment specific configuration information.



/* This call back function is called once the user is authenticated.  This function handles redirecting the user
 to their home page. */
function goToLandingPage() {

    global $server_web_root;

    global $user;

    if ($user->getRole('SENX') == 'ADM') {
        header("Location: /" . $server_web_root . "/senior-experience/admin");
    } else {
        header("Location: /" . $server_web_root . "/senior-experience/senior");
    }
}

require_once(__DIR__ . "/../../shared/util/main.php");

?>

