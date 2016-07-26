<?php

function get_room_list() {
    $query = 'SELECT rm_nbr, rm_id
              from room
              
			  order by rm_nbr';
    return get_list($query);
}

function add_room($rm_nbr) {

    global $db;

    $query = 'INSERT INTO room
                 (rm_nbr)
              VALUES
                 (:rm_nbr)';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':rm_nbr', $rm_nbr);


        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

function modify_room($rm_id, $rm_nbr) {

    global $db;

    $query = 'update room set
                 rm_nbr = :rm_nbr
                 where rm_id = :rm_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':rm_id', $rm_id);
        $statement->bindValue(':rm_nbr', $rm_nbr);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}


function get_room($rm_id) {

    global $db;

    $query = 'select * from room where rm_id = :rm_id';

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':rm_id', $rm_id);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}


function delete_room($rm_id){
    
    global $db;

    $query = 'delete from room
              where rm_id = :rm_id';
    try {
        $db->beginTransaction();
        update_pres_null_rm($rm_id);
        $statement = $db->prepare($query);
        $statement->bindValue(':rm_id', $rm_id);

        $statement->execute();
        $statement->closeCursor();
        $db->commit();
    } catch (PDOException $e) {
        $db->rollBack();
        display_db_exception($e);
        exit();
    }
}

function update_pres_null_rm($rm_id){

    global $db;
    global $app_cde;

    $update_table = ($app_cde == 'TPOR') ? 'test' : 'presentation';

    $query = 'update ' . $update_table . ' set
                 rm_id = null
                 where rm_id = :rm_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue('rm_id', $rm_id);
        $statement->execute();
        $statement->closeCursor();

    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}
?>

