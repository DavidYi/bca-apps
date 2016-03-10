<?php
/**
 * Created by PhpStorm.
 * User: macbook
 * Date: 3/9/16
 * Time: 9:19 AM
 */

require_once (__DIR__ . "/../util/main.php");

$app_cde = strtoupper(filter_input(INPUT_GET, "code"));
echo $app_cde;
if ($app_cde == null) {
    display_error("No application code has been passed in!");
    exit();
}

// FIXME Make this not hardcoded in the future
// In its current state, it requires someone to manually edit this page each time a new application is made
if ($app_cde == "SENX") {
    require_once (__DIR__ . "/../../senior-experience/model/database.php");
} else if ($app_cde == "CAR") {
    require_once (__DIR__ . "/../../career-day/model/database.php");
}

require_once (__DIR__ . "/../model/database.php");
require_once (__DIR__ . "/../model/admin_db.php");

$logs = get_log_messages("CAR");
include "view.php";
exit();