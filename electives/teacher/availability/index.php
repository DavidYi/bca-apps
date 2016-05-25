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
        include("/availability_view.php");
    case 'back':
        header('Location: http://localhost/bca-apps/electives/teacher/');

}

?>