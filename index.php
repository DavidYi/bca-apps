<?php
/**
 * Created by PhpStorm.
 * User: macbook
 * Date: 12/16/15
 * Time: 10:05 AM
 */

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