<?php
/**
 * Created by PhpStorm.
 * User: shawnrobin
 * Date: 7/27/16
 * Time: 11:12 AM
 */

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'default';
    }
}

switch ($action) {
    default:
        $free_mods = get_free_mods();
        include('./view.php');
        break;
}

?>