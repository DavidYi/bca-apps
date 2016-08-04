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
    global $app_cde;
    global $user;

    if ($user->getRole($app_cde) == NULL) {
        header("Location: /" . $server_web_root . "/teacher-proctoring/mainPage/");
    } else {
        header("Location: /" . $server_web_root . "/teacher-proctoring/admin/");

    }
}

/* These includes depend on the variables above, therefore they should be at the end of the file. */
require_once(__DIR__ . "/../../shared/util/main.php");

function verify_test_admin() {
    global $app_cde;
    global $app_url_path;
    global $user;

    verify_logged_in();

    if ($user->getRole($app_cde) == NULL) {
        log_error ("Permission exception in verify_admin.  User id:" . $user->usr_id);
        display_user_message("Permission denied.  You are not an administrator.", '/' . $app_url_path . '/index.php');
        exit();
    }
}
?>
