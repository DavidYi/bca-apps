<?php
/**
 * Created by PhpStorm.
 * User: daviyi
 * Date: 12/16/15
 * Time: 9:04 AM
 */
require_once("../util/main.php");
require_once("../admin/signins/sheetRequest");
require_once('../tcpdf/config/lang/eng.php');
require_once('../tcpdf/tcpdf.php');
$action =  strtolower(filter_input(INPUT_POST, 'action'));

if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'mentors';
    }
}
switch ($action){
    case 'mentors': //presenter
        $error_msg = '';
        break;

    case 'session':
        $error_msg = '';
        $session = filter_input(INPUT_POST, 'session');

        break;
}

?>