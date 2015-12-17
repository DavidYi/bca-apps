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


include("view.php");
exit();

?>