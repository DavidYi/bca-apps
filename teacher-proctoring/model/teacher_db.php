<?php

date_default_timezone_set('America/New_York');

function get_test_list($usr_id, $sort_by, $order_by, $filter_full, $filter_past) {
    $query = 'SELECT test_time_xref.test_id, test_time_xref.test_time_id, test_time_desc,
              test_name, test.test_type_cde, rm_id, test_dt, proc_needed, proc_enrolled,
              proc_needed - proc_enrolled as remaining, sort_order
              FROM test_time_xref
                INNER JOIN test ON test_time_xref.test_id = test.test_id
                INNER JOIN test_time ON test_time_xref.test_time_id = test_time.test_time_id
                INNER JOIN test_type ON test.test_type_cde = test_type.test_type_cde ';
    
    if ($filter_full == 0 || $filter_past == 0) {
        $query .= ("WHERE ");
        if ($filter_full == 0){
            $query .= ("proc_needed - proc_enrolled != 0 ");
            if ($filter_past == 0) $query .= ("AND ");
        } 
        if ($filter_past == 0) $query .= ("test_dt > DATE_SUB(CURDATE(), INTERVAL 7 DAY) ");
    }
    
    $query .= ("UNION 
        SELECT test_time_xref.test_id, test_time_xref.test_time_id, test_time_desc,
          test_name, test.test_type_cde, rm_id, test_dt, proc_needed, proc_enrolled,
          proc_needed - proc_enrolled as remaining, sort_order
        FROM test_updt_xref
          INNER JOIN test ON test.test_id = test_updt_xref.test_id
          INNER JOIN test_time ON test_time.test_time_id = test_updt_xref.test_time_id
          INNER JOIN test_time_xref ON test_time_xref.test_id = test_updt_xref.test_id
                                       AND test_time_xref.test_time_id = test_updt_xref.test_time_id
        WHERE usr_id = :usr_id ");

    if ($sort_by == 1) $query .= ('ORDER BY test_name');
    else if ($sort_by == 2) $query .= ('ORDER BY test_type_cde');
    else if ($sort_by == 3) $query .= ('ORDER BY sort_order');
    else if ($sort_by == 4) $query .= ('ORDER BY test_dt');
    else if ($sort_by == 5) $query .= ('ORDER BY remaining');
    else $query .= ('ORDER BY test_dt, test_id, test_time_id');
    if ($order_by == 2) $query .= (' DESC');

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
        exit();
    }
}

function get_selected_test_list($usr_id) {
    $query = 'SELECT distinct test_updt_xref.test_id, test_name, rm_id, test_dt,
                  test_time_desc, usr_id, test_updt_xref.test_time_id
              FROM test_updt_xref
                  INNER JOIN test ON test.test_id = test_updt_xref.test_id
                  INNER JOIN test_time ON test_time.test_time_id = test_updt_xref.test_time_id
                  INNER JOIN test_time_xref ON test_time_xref.test_id = test_updt_xref.test_id
                    AND test_time_xref.test_time_id = test_updt_xref.test_time_id
              WHERE usr_id = :usr_id
              ORDER BY test_dt, sort_order';
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

function get_selected_test($test_id) {
    $query = 'SELECT test_time_xref.test_id, test_time_xref.test_time_id, test_time_desc,
              test_name, test.test_type_cde, rm_id, test_dt, proc_needed, proc_enrolled,
              proc_needed - proc_enrolled as remaining, sort_order
              FROM test_time_xref
                INNER JOIN test ON test_time_xref.test_id = test.test_id
                INNER JOIN test_time ON test_time_xref.test_time_id = test_time.test_time_id
                INNER JOIN test_type ON test.test_type_cde = test_type.test_type_cde
              WHERE test_time_xref.test_id = :test_id';

    global $db;

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':test_id', $test_id);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_exception($e);
    }
    return get_list($query);
}

function get_teachers_from_test($test_id, $test_time_id) {
    $query = 'SELECT distinct usr_last_name, usr_first_name
                FROM user, test_updt_xref
                WHERE test_id = :test_id AND test_time_id = :test_time_id
                  AND test_updt_xref.usr_id = user.usr_id
                ORDER BY usr_last_name, usr_first_name';

    global $db;

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':test_id', $test_id);
        $statement->bindValue(':test_time_id', $test_time_id);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_exception($e);
    }
}

function get_count($usr_id){
    $query = 'SELECT count(distinct test.test_id, test_time_xref.test_time_id)
                from test, test_type, test_time, test_updt_xref, test_time_xref
                where usr_id = :usr_id
                and test_time.test_time_id = test_updt_xref.test_time_id
                and test.test_id = test_updt_xref.test_id
                and test_time_xref.test_time_id = test_updt_xref.test_time_id
                and test_time_xref.test_id = test_updt_xref.test_id';

    global $db;

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':usr_id', $usr_id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_exception($e);
    }
    return get_list($query);
}

function get_test_types() {
    $query = 'SELECT test_type_cde, test_type_desc
                from test_type';
    return get_list($query);
}

function get_teacher_list()
{
    $query = "SELECT usr_id, usr_bca_id, usr_type_cde, usr_class_year,
                 usr_first_name, usr_last_name, usr_active
              FROM user
              WHERE usr_active = 1
              AND usr_type_cde = 'ADM' OR usr_type_cde = 'TCH'
			  ORDER BY usr_type_cde, usr_last_name";

    return get_list($query);
}

function get_rooms() {
    $query = 'SELECT rm_id, rm_nbr
                from room';
    return get_list($query);
}

function add_test($test_name, $test_date, $test_cde, $test_room, $test_procs) {

    global $db;
    global $user;

    try {
        $db->beginTransaction();
        $query = 'INSERT INTO test
                    (test_id, test_type_cde, rm_id, test_name, test_dt)
                  VALUES
                    (NULL, :test_type_cde, :rm_id, :test_name, :test_dt)';
        $statement = $db->prepare($query);
        $statement->bindValue(':test_type_cde', $test_cde);
        $statement->bindValue(':rm_id', $test_room);
        $statement->bindValue(':test_name', $test_name);
        $statement->bindValue(':test_dt', $test_date);
        $statement->execute();
        $statement->closeCursor();
        
        $test_id =  $db->lastInsertId('test_id');
        $test_time_id = 1;

        foreach ($test_procs as $test_proc) {
            if ($test_proc > 0 && $test_proc <= 25) {
                $query2 = 'INSERT INTO test_time_xref
                            (test_id, test_time_id, proc_needed, proc_enrolled)
                          VALUES
                            (:test_id, :test_time_id, :proc_needed, 0)';
                $statement = $db->prepare($query2);
                $statement->bindValue(':test_id', $test_id);
                $statement->bindValue(':test_time_id', $test_time_id);
                $statement->bindValue(':proc_needed', $test_proc);
                $statement->execute();
                $statement->closeCursor();
            }
            $test_time_id++;
        }

        $db->commit();
    } catch (PDOException $e) {
        // roll back transaction
        $db->rollback();

        // log any errors to file
        log_pdo_exception($e, $user->usr_id, "Adding Test:" . $user->usr_id, "add_test");

        display_error($e);
        exit();
    }
}

function change_test($test_id, $test_name, $test_cde, $test_room, $test_date, $proc_times) {

    global $db;

    try {
        $db->beginTransaction();
        $query = 'UPDATE test
                    SET test_name = :test_name, test_type_cde = :test_type_cde,
                        rm_id = :rm_id, test_dt = :test_dt
                    WHERE test_id = :test_id';

        $statement = $db->prepare($query);
        $statement->bindValue(':test_id', $test_id);
        $statement->bindValue(':test_type_cde', $test_cde);
        $statement->bindValue(':rm_id', $test_room);
        $statement->bindValue(':test_name', $test_name);
        $statement->bindValue(':test_dt', $test_date);
        $statement->execute();
        $statement->closeCursor();

        $proc_index = 1;
        foreach($proc_times as $proc_num) {
            if ($proc_num > 0) {
                $query2 = 'INSERT INTO test_time_xref (test_id, test_time_id, proc_needed, proc_enrolled)
                              VALUES (:test_id, :test_time_id, :proc_needed, 0)
                           ON DUPLICATE KEY UPDATE proc_needed = :proc_needed';
                $statement = $db->prepare($query2);
                $statement->bindValue(':test_id', $test_id);
                $statement->bindValue(':test_time_id', $proc_index);
                $statement->bindValue(':proc_needed', $proc_num);
                $statement->execute();
                $statement->closeCursor();
            } else {
                $query3 = 'DELETE FROM test_updt_xref
                            WHERE test_id = :test_id
                              AND test_time_id = :test_time_id';
                $statement = $db->prepare($query3);
                $statement->bindValue(':test_id', $test_id);
                $statement->bindValue(':test_time_id', $proc_index);
                $statement->execute();
                $statement->closeCursor();

                $query4 = 'DELETE FROM test_time_xref
                            WHERE test_id = :test_id
                              AND test_time_id = :test_time_id';
                $statement = $db->prepare($query4);
                $statement->bindValue(':test_id', $test_id);
                $statement->bindValue(':test_time_id', $proc_index);
                $statement->execute();
                $statement->closeCursor();
            }
            $proc_index++;
        }
        $db->commit();
    } catch (PDOException $e) {
        // roll back transaction
        $db->rollback();

        // log any errors to file
        log_pdo_exception($e, $test_id, "Changing Test:" . $test_id, "change_test");

        display_error($e);
        exit();
    }
}

function del_user_tests($usr_id) {
    global $db;

    $query = 'delete from test_updt_xref where usr_id = :usr_id';

    $statement = $db->prepare($query);
    $statement->bindValue(':usr_id', $usr_id, PDO::PARAM_INT);
    $statement->execute();
    $statement->closeCursor();
}

function change_user_tests($tests) {

    global $db;
    global $user;

    try {
        $db->beginTransaction();

        del_user_tests($user->usr_id);

        if (!empty($tests)) {
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
                $statement->bindValue(':usr_id', $user->usr_id, PDO::PARAM_INT);
                $statement->bindValue(':updt_dt', $bindDate, PDO::PARAM_STR);
                $statement->bindValue(':updt_usr_id', $user->usr_id, PDO::PARAM_INT);
                $statement->execute();
                $statement->closeCursor();
            }
        }

        $db->commit();
    } catch (PDOException $e) {
        // roll back transaction
        $db->rollback();

        // log any errors to file
        log_pdo_exception($e, $user->usr_id, "Changing User's Tests:" . $user->usr_id, "change_user_tests");

        display_error($e);
        exit();
    }
}
?>