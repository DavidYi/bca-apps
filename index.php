<?php
/**
 * Created by PhpStorm.
 * User: macbook
 * Date: 12/16/15
 * Time: 10:05 AM
 */

require_once('util/main.php');
require_once('model/presentations_db.php');

$user = get_user($_SESSION['usr_id']);
$currentSession = filter_input(INPUT_GET, 'session');
if ($currentSession < 1 || $currentSession > 4) {
    $currentSession = 1;
}

$presentations = get_presentation_list($currentSession);

$pres_enrolled = get_presentation_by_user($user['usr_id'], $currentSession);
$is_enrolled = FALSE;

if ($pres_enrolled != NULL) {
    $is_enrolled = TRUE;
}


include("view.php");
exit();

?>