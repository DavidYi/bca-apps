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

function include_analytics() {
    echo (
    "<script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-71500783-1', 'auto');
        ga('send', 'pageview');
    </script>"
    );
}

function include_user_tracking() {
    $cur_user = get_user(filter_input(INPUT_POST, 'usr_id'));
    if ($cur_user != NULL) {
        echo(
            '<script>
                ga("create", "UA-71500783-1", "auto", "usr_id", {
                    usr_id: ' . $cur_user['usr_id'] . '
                });

                ga("create", "UA-71500783-1", "auto", "usr_type_cde", {
                    usr_id: ' . $cur_user['usr_type_cde'] . '
                });
            </script>'
        );
    }
}


?>