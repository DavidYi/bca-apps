<?php
/**
 * Created by PhpStorm.
 * User: matth
 * Date: 5/18/2016
 * Time: 9:14 AM
 */
require_once(__DIR__ . "/../../util/main.php");

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'default';
    }
}

switch ($action) {
    case 'default':
        include("../../Student/times/view.php");
    case 'back':
        if ($action == 'back') {
            header('Location: ..');
        }
    case 'update_times':
        echo "submit";
        echo var_dump($_POST);
        /*
         * The code from student will be incorporated here later
         */

}

?>