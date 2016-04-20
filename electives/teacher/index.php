<?php
/**
 * Created by PhpStorm.
 * User: macbook
 * Date: 1/5/16
 * Time: 2:04 PM
 */

require_once(__DIR__ . "/../util/main.php");
require_once(__DIR__ . "/../../shared/model/user_db.php");
require_once(__DIR__ . "/../model/teacher_db.php");

verify_logged_in();

$action = filter_input(INPUT_GET, 'action');
if (isset($action) and ($action == "logout")) {
    session_destroy();
    header("Location: ../index.php");
}

/* Kincent -- add queries to load availability and teacher courses here. */

include("./view.php");
exit();