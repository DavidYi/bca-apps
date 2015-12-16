<?php
# Localhost connection option
# $dsn = 'mysql:host=localhost;dbname=career_day';
# $username = 'caruser';

# Remote connection option
$dsn = 'mysql:host=webdev01.bergen.org;dbname=atcsdevb_career_day';
$username = 'atcsdevb_carusr';
$password = 'W[6V8tgSX=y~';
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

try {
    $db = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    include '../errors/db_error_connect.php';
    exit;
}

function display_db_error($error_message) {
    global $app_path;
    include '../errors/db_error.php';
    exit;
}



?>