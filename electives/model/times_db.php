<?php
/**
 * Created by PhpStorm.
 * User: joshClune
 * Date: 5/11/16
 * Time: 9:29 AM
 */
function get_times_list(){
    /*Will make*/
}

function get_times($usr_id){
    /*Will make*/
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

?>