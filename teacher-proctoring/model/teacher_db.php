<?php

date_default_timezone_set('America/New_York');

function get_test_list() {
    $query = 'SELECT test.test_id, test_name, rm_id, test_dt, test_time_xref.test_time_id,
                  test_time_desc, test.test_type_cde, proc_needed, proc_enrolled
                from test, test_type, test_time, test_time_xref
                where test.test_type_cde = test_type.test_type_cde
                and test.test_id = test_time_xref.test_id
                and test_time.test_time_id = test_time_xref.test_time_id
                order by test_dt, sort_order';
    return get_list($query);
}

function get_selected_test_list($usr_id) {
    $query = 'SELECT distinct test.test_id, test_name, rm_id, test_dt, test_time_desc, usr_id
                from test, test_type, test_time, test_updt_xref, test_time_xref
                where usr_id = :usr_id
                and test_time.test_time_id = test_updt_xref.test_time_id
                and test.test_id = test_updt_xref.test_id
                and test_time_xref.test_time_id = test_updt_xref.test_time_id
                and test_time_xref.test_id = test_updt_xref.test_id
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
    return get_list($query);
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

function del_user_tests($usr_id) {
    global $db;
    global $user;

    $query = 'delete from test_updt_xref where usr_id = :usr_id';

    $statement = $db->prepare($query);
    $statement->bindValue(':usr_id', $usr_id, PDO::PARAM_INT);
    $statement->execute();
    $statement->closeCursor();
}

function change_user_tests($usr_id, $tests) {

    global $db;
    global $user;

    try {
        $db->beginTransaction();

        del_user_tests($user->usr_id);

        $test_list = explode(',', $tests);
        foreach ($test_list as $test) {
            $test_split = explode(":", $test);

            $bindDate = date('Y-m-d H:i:s');
            $test_id = intval($test_split[0]);
            $test_time_id = intval($test_split[1]);
            $query = "INSERT INTO test_updt_xref (test_id, test_time_id, usr_id, updt_dt, updt_usr_id)
                      VALUES (:test_id, :test_time_id, :usr_id, :updt_dt, :updt_usr_id)";
                $statement = $db->prepare($query);
                $statement->bindValue(':test_id', $test_id, PDO::PARAM_INT);
                $statement->bindValue(':test_time_id', $test_time_id, PDO::PARAM_INT);
                $statement->bindValue(':usr_id', $usr_id, PDO::PARAM_INT);
                $statement->bindValue(':updt_dt', $bindDate, PDO::PARAM_STR);
                $statement->bindValue(':updt_usr_id', $usr_id, PDO::PARAM_INT);
                $statement->execute();
                $statement->closeCursor();
        }
        $db->commit();
    } catch (PDOException $e) {
        // roll back transaction
        $db->rollback();

        // log any errors to file
        log_pdo_exception ($e, $user->usr_id, "Deleting User's Tests:" . $usr_id, "del_user_tests");

        display_error($e);
        exit();
    }
}

//made changes in query
?>