<?php

function get_test_list() {
    $query = 'SELECT test_id, test_name, rm_id, test.test_type_cde, test_dt, test_time_id, test_time_desc
                from test, test_type, test_time
                where test.test_type_cde = test_type.test_type_cde
                order by test_dt, sort_order';
    return get_list($query);
}

function get_test_types() {
    $query = 'SELECT test_type_desc, test_type_cde
                from test_type';
    return get_list($query);
}

function get_rooms() {
    $query = 'SELECT rm_nbr, rm_id
                from room';
    return get_list($query);
}

function insertForMod ($test_id, $time_id, $num_of_proctors) {
    
    global $db;

    if ($num_of_proctors == "" || $num_of_proctors == "0"|| $num_of_proctors == null) {
        return;
    }
    
    $query = 'INSERT INTO test_time_xref (test_id, test_time_id, proc_needed)
          VALUES
             (:test_id, :time_id, :num_of_proctors)';


    $statement = $db->prepare($query);
    $statement->bindValue(':time_id', $time_id);
    $statement->bindValue(':test_id', $test_id);
    $statement->bindValue(':num_of_proctors', $num_of_proctors);
    $statement->execute();
    $statement->closeCursor();

}

function add_test ($date, $test_name, $test_cde, $room_id, $one_three, $four_six, $seven_nine, $ten_twelve, $thirteen_fifteen, $sixteen_eighteen, $nineteen_twentyone, $twentytwo_twentyfour, $twentyfive_twentyseven) {

    global $db;
    $query = 'INSERT INTO test (test_name, test_dt, test_type_cde, rm_id)
              VALUES
                 (:test_name, :date, :test_cde, :room_id)';
    try {
        $db->beginTransaction();
        $statement = $db->prepare($query);
        $statement->bindValue(':test_name', $test_name);
        $statement->bindValue(':date', $date);
        $statement->bindValue(':test_cde', $test_cde);
        $statement->bindValue(':room_id', $room_id);

        $statement->execute();
        $id = $db->lastInsertId();
        $statement->closeCursor();

        insertForMod ($id, '1', $one_three);
        insertForMod ($id, '2', $four_six);
        insertForMod ($id, '3', $seven_nine);
        insertForMod ($id, '4', $ten_twelve);
        insertForMod ($id, '5', $thirteen_fifteen);
        insertForMod ($id, '6', $sixteen_eighteen);
        insertForMod ($id, '7', $nineteen_twentyone);
        insertForMod ($id, '8', $twentytwo_twentyfour);
        insertForMod ($id, '9', $twentyfive_twentyseven);

        $db->commit();

    } catch (PDOException $e) {
        $db->rollback();
        display_db_exception($e);
        exit();
    }

}

?>
