<?php

function get_session_times() {
    $query = 	'SELECT ses_id, ses_name, ses_start, ses_end 
					from session_times
					order by sort_order';
					
    return get_list($query);
}

function get_session_times_by_id($ses_id) {
    $query = 'SELECT ses_start, ses_end
              FROM session_times
              WHERE ses_id = :ses_id';

    global $db;

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':ses_id', $ses_id);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function get_presentation_list($ses_id) {
    $query = 	'SELECT mentor.mentor_id,  mentor_last_name ,  mentor_first_name ,  mentor_field ,
					mentor_position , mentor_company ,  mentor_profile ,  mentor_keywords ,  
					mentor_email ,  mentor_cell_nbr , mentor_phone_nbr ,  mentor_address ,  
					mentor_source ,  mentor_notes ,  active ,  pres_room , pres_host_teacher ,  
					pres_max_capacity , presentation.pres_enrolled_count, presentation.pres_id
				FROM mentor
				INNER JOIN presentation ON presentation.mentor_id = mentor.mentor_id
				WHERE presentation.ses_id = :ses_id
				AND mentor.active =1
				AND presentation.pres_enrolled_count < mentor.pres_max_capacity
				ORDER BY mentor_field';
	
    global $db;

    try {
        $statement = $db->prepare($query);  
        $statement->bindValue(':ses_id', $ses_id);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }  
}

function get_presentation_by_user($usr_id, $ses_id) {
    $query = 'SELECT presentation.pres_id, mentor.pres_room, mentor.mentor_first_name,
                mentor.mentor_last_name, mentor.mentor_position, mentor.mentor_company
              FROM pres_user_xref
              INNER JOIN presentation on presentation.pres_id = pres_user_xref.pres_id
              INNER JOIN mentor on presentation.mentor_id = mentor.mentor_id
              WHERE ses_id = :ses_id
              AND usr_id = :usr_id';

    global $db;

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':ses_id', $ses_id);
        $statement->bindValue(':usr_id', $usr_id);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function get_user($usr_id) {
    $query = 	'SELECT usr_id, usr_bca_id, usr_type_cde, usr_role_cde, usr_class_year,
                    usr_first_name, usr_last_name, usr_active
                 FROM user
                 WHERE usr_id = :usr_id';

    global $db;

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':usr_id', $usr_id);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function get_user_list() {
    $query = 'SELECT usr_id, usr_bca_id, usr_type_cde, usr_class_year,
                 usr_first_name, usr_last_name, usr_active
              from user
              where usr_active = 1
			  order by usr_display_name';

    return get_list($query);
}

function get_sessions_by_user($usr_id) {
    $query = 'select session_times.ses_id ses_times, my_ses.ses_id ses_id, pres_room, pres_max_capacity, pres_enrolled_count, pres_id, mentor_position, mentor_company, mentor_field, mentor_last_name, mentor_first_name, ses_name, ses_start, ses_end, session_times.sort_order
              from session_times

              left join (
              select ses_id, pres_room, mentor_position, mentor_field, mentor_company, mentor_last_name, mentor_first_name, pres_max_capacity, pres_enrolled_count, presentation.pres_id
              from presentation
              inner join mentor on mentor.mentor_id = presentation.mentor_id
              inner join pres_user_xref on presentation.pres_id = pres_user_xref.pres_id
              where usr_id = :usr_id) my_ses on session_times.ses_id = my_ses.ses_id
              order by session_times.sort_order';

    global $db;

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':usr_id', $usr_id);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function add_presentation_for_user($pres_id, $usr_id) {
    $query = 'insert into pres_user_xref (pres_id, usr_id)
              VALUES (:pres_id, :usr_id)';

    global $db;

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(":pres_id", $pres_id);
        $statement->bindValue(":usr_id", $usr_id);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function delete_presentation_for_user($pres_id, $usr_id) {
    $query = 'delete from pres_user_xref
              WHERE pres_id = :pres_id
              and usr_id = :usr_id';

    global $db;

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(":pres_id", $pres_id);
        $statement->bindValue(":usr_id", $usr_id);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}
?>