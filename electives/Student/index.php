<?php

/**
 * Created by PhpStorm.
 * User: joshClune
 * Date: 4/6/16
 * Time: 10:36 AM
 */
include('../util/main.php');

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'list_options';
    }
}


switch ($action) {
    case 'list_options':
        include('./view.php');
        break;
    case 'modify_courses':
        echo "will make a modify_courses page later";
        include('./courses/index.php');
        break;
    case 'modify_times':
        include('./times/view.php');
        break;
    case 'logout':
        echo "will make a logout page later";
        break;
    case 'update_times':
        echo "update_times test ";

        $testarr = $_POST['time'];
        echo sizeof($testarr);

        include('./view.php');
        break;
    default:
        display_error('Unknown account action: ' . $action);
        exit();
        break;
}
?>
