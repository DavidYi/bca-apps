<?php
/**
 * Created by PhpStorm.
 * User: Luklas
 * Date: 12/16/15
 * Time: 9:39 AM
 */

function get_workshop_list() {
    $query = 'SELECT wkshp_id, wkshp_nme, wkshp_desc, format_id
              from workshop

			  order by wkshp_id';

    return get_list($query);
}


function add_workshop($wkshp_nme, $wkshp_desc, $format_id) {
    global $db;
    $query = 'INSERT INTO workshop
                 ($wkshp_nme, $wkshp_desc, $format_id)
              VALUES
                 (:wkshp_nme, $wkshp_desc, $format_id)';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':wkshp_nme', $wkshp_nme);
        $statement->bindValue(':wkshp_desc', $wkshp_desc);
        $statement->bindValue(':format_id', $format_id);


        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}



function modify_workshop($wkshp_nme, $wkshp_desc, $format_id) {
    global $db;
    $query = 'update workshop set
                 wkshp_nme = :wkshp_nme, wkshp_desc = :wkshp_desc,
                 format_id = :format_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':wkshp_nme', $wkshp_nme);
        $statement->bindValue(':wkshp_desc', $wkshp_desc);
        $statement->bindValue(':format_id', $format_id);

        $statement->execute();
        $statement->closeCursor();

    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

function get_workshop($wkshp_id) {
    global $db;
    $query = 'select * from workshop where wkshp_id = :wkshp_id';

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':wkshp_id', $wkshp_id);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

function get_format($format_id) {
    global $db;
    $query = 'select * from format where format_id = :format_id';

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':format_id', $format_id);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

function delete_workshop($wkshp_id){
    global $db;
    $query = 'delete from workshop
              where wkshp_id = :wkshp_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':wkshp_id', $wkshp_id);

        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

?>

