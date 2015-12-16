<?php

$app_name = 'bca-apps';     // Name of the app on the web server.  Change this if the directory changes.
$doc_root = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT', FILTER_SANITIZE_STRING); // Looks like c:/xampp/htdocs
$app_path = $doc_root . "/" . $app_name;   // Looks like c:/xampp/htdocs/bca-apps

// Set the include path
set_include_path($app_path . PATH_SEPARATOR . get_include_path());

//
// Start Session and security check.
// If the user is not logged in, send them to the login page.
//
session_start();
if (!isset($_SESSION['usr_id']))
{
    header('Location: /' . $app_name . '/login/index.php');
    exit();
}

//
// Common imports that should be available on all pages.
// Add them here.
//
require_once('model/database.php');


//
// Common methods that should be available on all pages.
// Add them here.
//
function display_error($error_message) {
    include 'errors/error.php';
    exit;
}

function verify_admin() {
    if (!isset($_SESSION['usr_role_cde'])) {
        include 'errors/invaliduser.html';
        exit();
    } elseif ($_SESSION['usr_role_cde'] != "ADM") {
        include 'errors/invaliduser.html';
        exit();
    } else {
        return;
    }
}


?>
