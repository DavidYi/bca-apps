<?php
/**
 * Created by PhpStorm.
 * User: Luklas
 * Date: 12/16/15
 * Time: 9:39 AM
 */

function get_workshop_list() {
    $query = 'SELECT wrkshp_id, wkshp_nme, wkshp_desc, format_id
              from workshop

			  order by wrkshp_id';

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

function get_workshop($wrkshp_id) {
    global $db;
    $query = 'select * from workshop where wrkshp_id = :wrkshp_id';

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':wrkshp_id', $wrkshp_id);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

function delete_workshop($wrkshp_id){
    global $db;
    $query = 'delete from workshop
              where wrkshp_id = :wrkshp_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':wrkshp_id', $wrkshp_id);

        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

?>

