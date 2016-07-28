<?php
$app_cde = 'OELE';
$app_title = 'Off-hour Elective Registration';

// Provides environment specific configuration information.
include(__DIR__ . "/../../config.php");

$app_url_path = $server_web_root . '/electives';
$shared_ss_url = '/' .$server_web_root . '/shared/ss/main.css';

/* These includes depend on the variables above, therefore they should be at the end of the file. */
require_once(__DIR__ . "/../../shared/util/main.php");

?>