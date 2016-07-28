<?php
/**
 * Created by PhpStorm.
 * User: Luklas
 * Date: 12/16/15
 * Time: 9:39 AM
 */

function get_user_mimic_list() {
    $query = 'SELECT usr_id, usr_bca_id, usr_type_cde, usr_class_year,
                 usr_first_name, usr_last_name, usr_active
              from user
              where usr_active = 1
              and usr_type_cde = \'STD\'
			  order by usr_class_year, usr_display_name';

    return get_list($query);
}

function get_mentor_list() {
    $query = 'SELECT mentor_id, mentor_last_name, mentor_first_name, mentor_field,
                 mentor_position, mentor_company, mentor_profile, mentor_keywords,
                  active, pres_room, pres_host_teacher,
                  pres_max_capacity
              from mentor
              where active = 1
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



function modify_mentor($mentor_id, $mentor_last_name, $mentor_first_name, $mentor_suffix, $mentor_field, $mentor_position, $mentor_company, $mentor_profile, $mentor_keywords,
                       $pres_room, $pres_host_teacher, $pres_max_capacity, $mentor_sessions) {
    global $db;
    $query = 'update mentor set
                 mentor_last_name = :mentor_last_name, mentor_first_name = :mentor_first_name,
                 mentor_suffix = :mentor_suffix,
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
        $statement->bindValue(':mentor_suffix', $mentor_suffix);
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

        $db->beginTransaction();
        for ($i = 0; $i < 4; $i++) {
            $presentation = get_presentation_by_mentor_session($mentor_id, $i+1);
            if (!empty($presentation) && empty($mentor_sessions[$i])) {
                $query = 'select pres_id from presentation where mentor_id = :mentor_id
                            and ses_id = :ses_id';
                $statement = $db->prepare($query);
                $statement->bindValue(':mentor_id', $mentor_id);
                $statement->bindValue(':ses_id', $i+1);
                $statement->execute();
                $result = $statement->fetch();
                $statement->closeCursor();

                $pres_id = $result['pres_id'];
                $query = 'delete from pres_user_xref where pres_id = :pres_id';
                $statement = $db->prepare($query);
                $statement->bindValue(':pres_id', $pres_id);
                $statement->execute();
                $statement->closeCursor();

                $query = 'delete from presentation where mentor_id = :mentor_id
                            and ses_id = :ses_id';
                $statement = $db->prepare($query);
                $statement->bindValue(':mentor_id', $mentor_id);
                $statement->bindValue(':ses_id', $i+1);
                $statement->execute();
                $statement->closeCursor();
            } elseif (empty($presentation) && !empty($mentor_sessions[$i])) {
                $query = 'insert into presentation values (NULL, :ses_id, :mentor_id, 0, NULL)';
                $statement = $db->prepare($query);
                $statement->bindValue(':mentor_id', $mentor_id);
                $statement->bindValue(':ses_id', $i+1);
                $statement->execute();
                $statement->closeCursor();
            }
        }
        $db->commit();
    } catch (PDOException $e) {
        display_db_exception($e);
        $db->rollBack();
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

function get_presentation_by_mentor_session($mentor_id, $ses_id) {
    global $db;
    $query = 'select * from presentation where mentor_id = :mentor_id
                and ses_id = :ses_id';

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':mentor_id', $mentor_id);
        $statement->bindValue(':ses_id', $ses_id);
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

    $query = 'select pres_id from presentation where mentor_id = :mentor_id';

    try {
        $db->beginTransaction();

        $statement = $db->prepare($query);
        $statement->bindValue(':mentor_id', $mentor_id);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();

        $query = 'delete from presentation where mentor_id = :mentor_id';

        $statement = $db->prepare($query);
        $statement->bindValue(':mentor_id', $mentor_id);
        $statement->execute();
        $statement->closeCursor();

        $query = 'delete from mentor where mentor_id = :mentor_id';

        $statement = $db->prepare($query);
        $statement->bindValue(':mentor_id', $mentor_id);
        $statement->execute();
        $statement->closeCursor();

        foreach ($result as $id) {
            $query = 'delete from pres_user_xref where pres_id = :pres_id';
            $statement = $db->prepare($query);
            $statement->bindValue(':pres_id', $id['pres_id']);
            $statement->execute();
            $statement->closeCursor();
        }

        $db->commit();
    } catch (PDOException $e) {
        $db->rollBack();
        display_db_exception($e);
        exit();
    }
}
?>