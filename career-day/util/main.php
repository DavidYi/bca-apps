<?php
//
// Common imports that should be available on all pages.
// Add them here.
//
require_once(__DIR__ . "/../model/database.php");
require_once(__DIR__ . "/../../shared/model/user_db.php");

$error_message = "";
$app_cde = 'CAR';

$doc_root = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT', FILTER_SANITIZE_STRING); // Looks like c:/xampp/htdocs

///////////////////
// For Production
// $app_name = 'careerday';     // Name of the app on the web server.  Change this if the directory changes.
// $app_path =  "/home2/bryres/public_html/" . $app_name;   // Looks like c:/xampp/htdocs/bca-apps

///////////////////
// For Test Server
// $app_name = 'bca-apps';     // Name of the app on the web server.  Change this if the directory changes.
// $app_path =  "/home2/atcsdevbergen/public_html/" . $app_name;   // Looks like c:/xampp/htdocs/bca-apps

//////////////////////////
// For Developer Machines
$app_name = 'bca-apps/career-day';     // Name of the app on the web server.  Change this if the directory changes.
$app_path = $doc_root . "/" . $app_name;   // Looks like c:/xampp/htdocs/bca-apps

///////////////////////
// Set the include path
set_include_path($app_path . PATH_SEPARATOR . get_include_path());

////////////////////////////
// Start Session and security check.
// If the user is not logged in, send them to the login page.
//
session_start();
$user = $_SESSION['user'];
if (!isset($user))
{
    header('Location: /' . $app_name . '/index.php');
    exit();
}




//
// Common methods that should be available on all pages.
// Add them here.
//
function display_error($error_message) {
    global $app_name;
    include __DIR__ . '/../errors/error.php';
    exit();
}

function log_exception ($exception, $usr_id, $src, $method)
{
    $query = 'insert into log (log_lvl_cde, log_msg, log_src, log_mthd, usr_id)
              VALUES (\'ERR\',:log_msg, :log_src, :log_mthd, :usr_id)';

    global $db;

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(":log_msg", $exception->getMessage());
        $statement->bindValue(":log_src", $src);
        $statement->bindValue(":log_mthd", $method);
        $statement->bindValue(":usr_id", $usr_id);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function log_pdo_exception ($exception, $usr_id, $src, $method)
{
    $query = 'insert into log (log_lvl_cde, log_msg, log_src, log_mthd,
                usr_id, log_pdo_code, log_pdo_file, log_pdo_line, log_pdo_msg)
              VALUES (\'ERR\',:log_msg, :log_src, :log_mthd,
               :usr_id, :log_pdo_code, :log_pdo_file, :log_pdo_line, :log_pdo_msg)';

    global $db;

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(":log_msg", $exception->getMessage());
        $statement->bindValue(":log_src", $src);
        $statement->bindValue(":log_mthd", $method);
        $statement->bindValue(":usr_id", $usr_id);
        $statement->bindValue(":log_pdo_code", $exception->getCode());
        $statement->bindValue(":log_pdo_file", $exception->getFile());
        $statement->bindValue(":log_pdo_line", $exception->getLine());
        $statement->bindValue(":log_pdo_msg", $exception->getMessage());
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function verify_admin() {
    global $app_cde;
    global $app_name;

    if ($_SESSION['user']->getRole($app_cde) != 'ADM') {
        $app_name = $app_name; // Remove unused variable warning.  Need variable for invaliduser.

        include __DIR__ . '/../errors/invaliduser.html';
        exit();
    }
}

function include_analytics() {
    include_page_tracking();
    include_user_tracking();
}

function include_page_tracking() {
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
    $cur_user = $_SESSION['user'];
    if ($cur_user != NULL) {
        echo(
            '<script>
                ga("create", "UA-71500783-1", "auto", "usr_id", {
                    usr_id: "' . $cur_user->usr_id . '"
                });

                ga("create", "UA-71500783-1", "auto", "usr_type_cde", {
                    usr_type_cde: "' . $cur_user->usr_type_cde . '"
                });
            </script>'
        );
    }
}


?>