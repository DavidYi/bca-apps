<?php
//
// Common imports that should be available on all pages.
// Add them here.
//
require_once(__DIR__ . "/../model/database.php");
require_once(__DIR__ . "/../../shared/model/user_db.php");

# I don't think we need this, but maybe we do?  We shall see.
# $error_message = "";

////////////////////////////
// Start Session and security check.
// If the user is not logged in, send them to the login page.
//
session_start();
$user = $_SESSION['user'];
if (!isset($user))
{
    header('Location: /' . $app_url_path . '/index.php');
    exit();
}

//
// Common methods that should be available on all pages.
// Add them here.
//
function display_error($error_message) {
    global $app_url_path;
    global $error_page_path;

    include $error_page_path;
    exit();
}

function log_exception ($exception, $usr_id, $src, $method)
{
    $query = 'insert into log (log_lvl_cde, log_msg, log_src, log_mthd, usr_id, app_cde)
              VALUES (\'ERR\',:log_msg, :log_src, :log_mthd, :usr_id, :app_cde)';

    global $db;
    global $app_cde;

    try {
        error_log("log_exception:" . $exception->getMessage(), 0);

        $statement = $db->prepare($query);
        $statement->bindValue(":log_msg", $exception->getMessage());
        $statement->bindValue(":log_src", $src);
        $statement->bindValue(":log_mthd", $method);
        $statement->bindValue(":usr_id", $usr_id);
        $statement->bindValue(":app_cde", $app_cde);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
    }
}

function log_pdo_exception ($exception, $usr_id, $src, $method)
{
    $query = 'insert into log (log_lvl_cde, log_msg, log_src, log_mthd,
                usr_id, log_pdo_code, log_pdo_file, log_pdo_line, log_pdo_msg, app_cde)
              VALUES (\'ERR\',:log_msg, :log_src, :log_mthd,
               :usr_id, :log_pdo_code, :log_pdo_file, :log_pdo_line, :log_pdo_msg, :app_cde)';

    global $db;
    global $app_cde;

    try {
        error_log("log_pdo_exception:" . $exception->getMessage(), 0);

        $statement = $db->prepare($query);
        $statement->bindValue(":log_msg", $exception->getMessage());
        $statement->bindValue(":log_src", $src);
        $statement->bindValue(":log_mthd", $method);
        $statement->bindValue(":usr_id", $usr_id);
        $statement->bindValue(":log_pdo_code", $exception->getCode());
        $statement->bindValue(":log_pdo_file", $exception->getFile());
        $statement->bindValue(":log_pdo_line", $exception->getLine());
        $statement->bindValue(":log_pdo_msg", $exception->getMessage());
        $statement->bindValue(":app_cde", $app_cde);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
    }
}

function verify_admin() {
    global $app_cde;
    global $app_url_path;

    if ($_SESSION['user']->getRole($app_cde) != 'ADM') {
        $app_url_path = $app_url_path; // Remove unused variable warning.  Need variable for invaliduser.

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