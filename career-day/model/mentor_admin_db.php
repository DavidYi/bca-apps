<?php
/**
 * Created by PhpStorm.
 * User: Luklas
 * Date: 12/16/15
 * Time: 9:39 AM
 */

function get_mentor_list() {
    $query = 'SELECT mentor_id, mentor_last_name, mentor_first_name, mentor_field,
                 mentor_position, mentor_company, mentor_profile, mentor_keywords,
                  active, pres_room, pres_host_teacher,
                  pres_max_capacity
              from mentor

			  order by mentor_last_name';

    return get_list($query);
}


function add_mentor($mentor_last_name, $mentor_first_name, $mentor_field, $mentor_position, $mentor_company, $mentor_profile, $mentor_keywords
    ,  $pres_room,
                    $pres_host_teacher, $pres_max_capacity) {
    global $db;
    $query = 'INSERT INTO mentor
                 (mentor_last_name, mentor_first_name, mentor_field, mentor_position, mentor_company, mentor_profile, mentor_keywords
                 , active, pres_room,
                 pres_host_teacher, pres_max_capacity)
              VALUES
                 (:mentor_last_name, :mentor_first_name, :mentor_field, :mentor_position, :mentor_company, :mentor_profile, :mentor_keywords
                 , 1, :pres_room,
                 :pres_host_teacher, :pres_max_capacity)';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':mentor_last_name', $mentor_last_name);
        $statement->bindValue(':mentor_first_name', $mentor_first_name);
        $statement->bindValue(':mentor_field', $mentor_field);
        $statement->bindValue(':mentor_position', $mentor_position);
        $statement->bindValue(':mentor_company', $mentor_company);
        $statement->bindValue(':mentor_profile', $mentor_profile);
        $statement->bindValue(':mentor_keywords', $mentor_keywords);
        $statement->bindValue(':pres_room', $pres_room);
        $statement->bindValue(':pres_host_teacher', $pres_host_teacher);
        $statement->bindValue(':pres_max_capacity', $pres_max_capacity);


        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}



function modify_mentor($mentor_id, $mentor_last_name, $mentor_first_name, $mentor_field, $mentor_position, $mentor_company, $mentor_profile, $mentor_keywords,
                       $pres_room,
                       $pres_host_teacher, $pres_max_capacity) {
    global $db;
    $query = 'update mentor set
                 mentor_last_name = :mentor_last_name, mentor_first_name = :mentor_first_name,
                  mentor_field = :mentor_field, mentor_position = :mentor_position,
                  mentor_company = :mentor_company,
                  mentor_profile = :mentor_profile, mentor_keywords = :mentor_keywords
                 , pres_room = :pres_room,
                 pres_host_teacher = :pres_host_teacher,
                 pres_max_capacity = :pres_max_capacity WHERE mentor_id = :mentor_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':mentor_last_name', $mentor_last_name);
        $statement->bindValue(':mentor_id', $mentor_id);
        $statement->bindValue(':mentor_first_name', $mentor_first_name);
        $statement->bindValue(':mentor_field', $mentor_field);
        $statement->bindValue(':mentor_position', $mentor_position);
        $statement->bindValue(':mentor_company', $mentor_company);
        $statement->bindValue(':mentor_profile', $mentor_profile);
        $statement->bindValue(':mentor_keywords', $mentor_keywords);
        $statement->bindValue(':pres_room', $pres_room);
        $statement->bindValue(':pres_host_teacher', $pres_host_teacher);
        $statement->bindValue(':pres_max_capacity', $pres_max_capacity);


        $statement->execute();
        $statement->closeCursor();

    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

function get_mentor($mentor_id) {
    global $db;
    $query = 'select * from mentor where mentor_id = :mentor_id';

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':mentor_id', $mentor_id);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

function delete_mentor($mentor_id){
    global $db;
    $query = 'update mentor set active = 0 where mentor_id = :mentor_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':mentor_id', $mentor_id);

        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

?>