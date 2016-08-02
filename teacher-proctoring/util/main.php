<?php
//
// Common imports that should be available on all pages.
// Add them here.
//
$app_cde = 'TPOR';
$app_title = 'Teacher Proctoring';

// Provides environment specific configuration information.
include(__DIR__ . "/../../config.php");

$shared_ss_url = '/' . $server_web_root . '/shared/ss/main.css';
$app_url_path = $server_web_root . '/teacher-proctoring';


function goToLandingPage()
{
    global $server_web_root;

    global $user;

    if ($user->getRole('TPOR') == 'ADM') {
        header("Location: /" . $server_web_root . "/teacher-proctoring/admin/");
    } else {
        header("Location: /" . $server_web_root . "/teacher-proctoring/itinerary/");

    }
}

/* These includes depend on the variables above, therefore they should be at the end of the file. */
require_once(__DIR__ . "/../../shared/util/main.php");

?>
