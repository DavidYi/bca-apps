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
$all_presentations = get_presentation_list(1);


$action = strtolower(filter_input(INPUT_POST, 'action'));


if ($action == NULL) {
    $action = "show_view";
}

switch ($action) {
    case 'show_view':
        break;
    case 'register':
        break;
}

?>