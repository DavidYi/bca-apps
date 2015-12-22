<?php
# Localhost connection option
#$dsn = 'mysql:host=localhost;dbname=career_day';
#$username = 'careeruser';
#$password = 'happy';

# Remote connection option
$dsn = 'mysql:host=webdev01.bergen.org;dbname=atcsdevb_career_day';
$username = 'atcsdevb_carusr';
$password = 'W[6V8tgSX=y~';
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

try {
    $db = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    echo $error_message;
#    include 'errors/db_error_connect.php';
    exit;
}

function display_db_error($error_message) {
    global $app_path;
    include 'errors/db_error.php';
    exit;
}

function get_list ($query) {
    global $db;

    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}



?>