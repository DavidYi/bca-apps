<?php

try {
    $db = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    error_log("Unable to connect to database: " . $e->getMessage(), 0);

    display_error ("Unable to connect to database.");
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
        log_pdo_exception($e, $_SESSION['user'].usr_id, 'database.php', 'get_list');
        display_error ("An error has occurred.");
    }
}



?>