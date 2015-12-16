<?php
/**
 * Created by PhpStorm.
 * User: daviyi
 * Date: 12/16/15
 * Time: 9:04 AM
 */
require_once("../admin/signins/sheetRequest");
require_once('tcpdf/config/lang/eng.php');
require_once('tcpdf/tcpdf.php');
$action = filter_input(INPUT_POST, 'action');

switch ($action){
    case 'mentors': //presenter

        break;

    case 'class':
        break;
}

?>