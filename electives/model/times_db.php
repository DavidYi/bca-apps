<?php
/**
 * Created by PhpStorm.
 * User: joshClune
 * Date: 5/11/16
 * Time: 9:29 AM
 */

function update_times($usr_id, $time) {
    global $db;
    $time_id = get_time_id($time);
    
    $query = "insert into elect_user_free_xref(usr_id, time_id, updt_usr_id)
              VALUES (:usr_id, :time_id, :usr_id)";

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':time_id', $time_id);
        $statement->bindValue(':usr_id', $usr_id);
        $statement->execute();
        $statement->closeCursor();

    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

// clears all times in database for specific usr_id in preparation for update_times()
function reset_times($id) {
    global $db;
    $query = "delete from elect_user_free_xref
              where usr_id = :id";

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

// returns the time_id of the given time_short_desc
function get_time_id($time) {
    global $db;
    $query = "select time_id
              from elect_time
              where time_short_desc = :time";

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':time', $time);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();

        return $result[0]["time_id"];
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

function get_times($usr_id){
    global $db;
    $query = "select day, mods, time_short_desc
              from elect_user_free_xref x, elect_time e
              where x.usr_id = :usr_id
              and x.time_id = e.time_id";

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

function get_usr_id($usr_first_name, $usr_last_name){
    global $db;
    $query = "select usr_id
              from user
              where usr_first_name= :usr_first_name
              and usr_last_name= :usr_last_name";

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':usr_first_name', $usr_first_name);
        $statement->bindValue(':usr_last_name', $usr_last_name);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();

        $usr_id = $result['usr_id'];
        return $usr_id;
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

function convert_times_arr($inputTimesArr){
    global $db;


    $query = "insert into elect_user_free_xref (usr_id, time_id)
              values (13, 9)";

    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();

        $usr_id = $result['usr_id'];
        return $usr_id;
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

?>