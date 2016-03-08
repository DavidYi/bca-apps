<?php

function get_room($rm_id) {
    global $db;

    $query = "SELECT rm_id, rm_nbr, rm_cap
              FROM room
              WHERE rm_id = :rm_id
              ORDER BY rm_nbr";

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(":rm_id", $rm_id);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

function get_room_list() {
    $query = "SELECT rm_id, rm_cap, rm_nbr
              FROM room
              ORDER BY rm_nbr";
    return get_list($query);
}

function add_room($rm_nbr, $rm_cap) {
    global $db;

    $query = "INSERT INTO room
              (rm_nbr, rm_cap)
              VALUES
              (:rm_nbr, :rm_cap)";

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(":rm_nbr", $rm_nbr);
        $statement->bindValue(":rm_cap", $rm_cap);

        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

function modify_room($rm_id, $rm_nbr, $rm_cap) {
    global $db;

    $query = "UPDATE room
              SET rm_nbr = :rm_nbr,
                  rm_cap = :rm_cap
              WHERE rm_id = :rm_id";

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(":rm_id", $rm_id);
        $statement->bindValue(":rm_nbr", $rm_nbr);
        $statement->bindValue(":rm_cap", $rm_cap);

        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

function delete_room($rm_id) {
    global $db;

    $query = "DELETE FROM room
              WHERE rm_id = :rm_id";

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(":rm_id", $rm_id);

        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

function get_field ($field_id) {
    global $db;

    $query = "SELECT field_id, field_name
              FROM field
              WHERE field_id = :field_id
              ORDER BY field_name";

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(":field_id", $field_id);

        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

function get_field_list() {
    $query = "SELECT field_id, field_name
              FROM field
              ORDER BY field_name";
    return get_list($query);
}

function add_field ($field_name) {
    global $db;

    $query = "INSERT INTO field
              (field_name)
              VALUES
              (:field_name)";

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(":field_name", $field_name);

        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

function modify_field($field_id, $field_name) {
    global $db;

    $query = "UPDATE field
              SET field_name = :field_name
              WHERE field_id = :field_id";

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(":field_id", $field_id);
        $statement->bindValue(":field_name", $field_name);

        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

function delete_field($field_id) {
    global $db;

    $query = "DELETE FROM field
              WHERE field_id = :field_id";

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(":field_id", $field_id);

        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

