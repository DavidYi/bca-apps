<?php

function get_test_list() {
    $query = 'SELECT test_id, test_name, rm_id, test_dt, test_time_id, test_time_desc, test.test_type_cde
                from test, test_type, test_time
                where test.test_type_cde = test_type.test_type_cde
                order by test_dt, sort_order';
    return get_list($query);
}

function get_selected_test_list($usr_id) {
    $query = 'SELECT distinct test.test_id, test_name, rm_id, test_dt, test_time_desc, usr_id
                from test, test_type, test_time, test_updt_xref, test_time_xref
                where test.test_type_cde = test_type.test_type_cde
                and test_updt_xref.test_id = test_time_xref.test_id
                and test_time_xref.test_id = test.test_id
                and usr_id = :usr_id
                order by test_dt, sort_order';
    global $db;

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':usr_id', $usr_id);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_exception($e);
    }
}

function get_test_types() {
    $query = 'SELECT test_type_desc
                from test_type';
    return get_list($query);
}

function get_rooms() {
    $query = 'SELECT rm_nbr
                from room';
    return get_list($query);
}

//made changes in query
?>