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
			  order by usr_display_name';

    return get_list($query);
}
?>