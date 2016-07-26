<?php
//
// Common imports that should be available on all pages.
// Add them here.
//
$app_cde = 'SENX';
$app_title = 'Senior Expositions';
$shared_ss_url = '/bca-apps/shared/ss/main.css';

$doc_root = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT', FILTER_SANITIZE_STRING); // Looks like c:/xampp/htdocs

///////////////////
// For Production
// $app_url_path = 'careerday';     // Name of the app on the web server.  Change this if the directory changes.
// $app_server_path =  "/home2/bryres/public_html/" . $app_url_path;   // Looks like c:/xampp/htdocs/bca-apps

///////////////////
// For Test Server
// $app_url_path = 'bca-apps';     // Name of the app on the web server.  Change this if the directory changes.
// $app_server_path =  "/home2/atcsdevbergen/public_html/" . $app_url_path;   // Looks like c:/xampp/htdocs/bca-apps

//////////////////////////
// For Developer Machines
$app_url_path = 'bca-apps/senior-experience';     // Name of the app on the web server.  Change this if the directory changes.
$app_server_path = $doc_root . "/" . $app_url_path;   // Looks like c:/xampp/htdocs/bca-apps

///////////////////////
// Set the include path
set_include_path($app_server_path . PATH_SEPARATOR . get_include_path());

/* These includes depend on the variables above, therefore they should be at the end of the file. */
require_once(__DIR__ . "/../model/database.php");
require_once(__DIR__ . "/../../shared/util/main.php");

?>