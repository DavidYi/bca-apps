<?php
/**
 * Created by PhpStorm.
 * User: matth
 * Date: 4/6/2016
 * Time: 10:09 AM
 */

$day = "";
$startMod = 0;
$endMod = 0;
$mods = "";
$className = "";
if (isset($_POST)) {
    $day = $_POST["day"];
    $mods = $_POST["mods"];
    $className = $_POST["class_name"];

    $startMod = intval(substr($mods, 0,1));
    $endMod = intval(substr($mods, 2, 1));
}

?>