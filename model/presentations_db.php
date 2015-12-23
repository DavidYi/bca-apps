<?php
function get_list ($query) {
    global $db;

    try {
        $statement = $db->prepare($query);  
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }    
}

function get_session_times() {
    $query = 	'SELECT ses_id, ses_name, ses_start, ses_end 
					from session_times
					order by sort_order';
					
    return get_list($query);
}

function get_presentation_list($ses_id) {
    $query = 	'SELECT mentor.mentor_id,  mentor_last_name ,  mentor_first_name ,  mentor_field ,
					mentor_position , mentor_company ,  mentor_profile ,  mentor_keywords ,  
					mentor_email ,  mentor_cell_nbr , mentor_phone_nbr ,  mentor_address ,  
					mentor_source ,  mentor_notes ,  active ,  pres_room , pres_host_teacher ,  
					pres_max_capacity , presentation.pres_enrolled_count
				FROM mentor
				INNER JOIN presentation ON presentation.mentor_id = mentor.mentor_id
				WHERE presentation.ses_id = :ses_id
				AND mentor.active =1
				ORDER BY mentor_last_name, mentor_first_name';
	
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

function get_user($usr_id) {
    $query = 	'SELECT usr_id, usr_bca_id, usr_type_cde, usr_class_year,
                    usr_first_name, usr_last_name, usr_display_name, usr_active
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
                 usr_first_name, usr_last_name, usr_display_name, usr_active
              from user
			  order by usr_display_name';

    return get_list($query);
}

function get_registered_users(){
    $query = 'select grade_lvl, count(*)
    from (
    SELECT grade_lvl, user.usr_id, count(*) as num_sessions
    from signup_dates
    inner join user on user.usr_class_year = signup_dates.class_year
    inner join pres_user_xref on pres_user_xref.usr_id = user.usr_id
    where usr_active = 1
    and usr_type_cde = \'STD\'
    group by grade_lvl, user.usr_id
    having num_sessions = 4j
    ) temp
    group by grade_lvl
';
    return get_list($query);
}

function get_partial_registered_users(){
    $query = 'select grade_lvl, count(*)
    from (
    SELECT grade_lvl, user.usr_id, count(*) as num_sessions
    from signup_dates
    inner join user on user.usr_class_year = signup_dates.class_year
    inner join pres_user_xref on pres_user_xref.usr_id = user.usr_id
    where usr_active = 1
    and usr_type_cde = \'STD\'
    group by grade_lvl, user.usr_id
    having num_sessions < 4
    ) temp
    group by grade_lvl
';
    return get_list($query);
}
function get_unregistered_users(){
    $query = 'SELECT grade_lvl, count(*)
    from user
    inner join signup_dates on signup_dates.class_year= user.usr_class_year
    left join pres_user_xref on pres_user_xref.usr_id= user.usr_id
    where pres_user_xref.usr_id is null
    and usr_type_cde = \'STD\'
    and usr_active = 1
    group by grade_lvl
';
    return get_list($query);
}
// TODO: Implement get all session time query
// TODO: Implement change session keys query
x?>