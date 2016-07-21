<?php
/**
 * Created by PhpStorm.
 * User: joshClune
 * Date: 5/11/16
 * Time: 9:29 AM
 */

function update_times($usr_id, $time) {
    global $db;

    $query = "insert into elect_user_free_xref(usr_id, time_id, updt_usr_id)
              VALUES (:usr_id, :time_id, :usr_id)";

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':time_id', $time);
        $statement->bindValue(':usr_id', $usr_id);
        $statement->execute();
        $statement->closeCursor();

    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

/*  returns strings listing mods available for each day
    for use in teacher/view.php
*/
function get_time_strings($id) {
    global $db;
    $query = "select day, GROUP_CONCAT(mods order by sort_order SEPARATOR ', ') as mods_available
            from elect_user_free_xref x, elect_time t, user u
            where x.time_id = t.time_id
            and x.usr_id = u.usr_id
            and u.usr_id = :usr_id
            group by day
            order by day_order";

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':usr_id', $id);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();

        return $result;
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

function get_times($usr_id){
    global $db;
    $query = "select x.time_id, day, mods
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