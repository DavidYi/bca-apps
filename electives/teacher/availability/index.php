<?php
/**
 * Created by PhpStorm.
 * User: matth
 * Date: 7/13/2016
 * Time: 11:51 AM
 */
require_once(__DIR__ . "/../../util/main.php");
require_once(__DIR__ . "/../../model/teacher_db.php");

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'default';
    }
}