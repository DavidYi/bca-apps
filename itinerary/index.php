<?php
/**
 * Created by PhpStorm.
 * User: macbook
 * Date: 1/5/16
 * Time: 2:04 PM
 */

require_once("../util/main.php");
require_once("model/presentations_db.php");


$user = get_user($_SESSION['usr_id']);
$sessions = get_sessions_by_user($user['usr_id']);

include ("itinerary/view.php");
exit();