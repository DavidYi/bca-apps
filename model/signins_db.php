<?php
/**
 * Created by PhpStorm.
 * User: daviyi
 * Date: 12/18/2015
 * Time: 1:45 PM
 */
require_once "../model/database.php";

function get_session_times()
{
    $query = 'SELECT ses_id, ses_name, ses_start, ses_end
					from session_times
					order by sort_order';

    return get_list($query);
}

function get_mentors()
{
    $query = 'SELECT mentor.mentor_id,  mentor_last_name ,  mentor_first_name ,  mentor_field ,
					mentor_position , mentor_company ,  mentor_profile ,  mentor_keywords ,
					mentor_email ,  mentor_cell_nbr , mentor_phone_nbr ,  mentor_address ,
					mentor_source ,  mentor_notes ,  active ,  pres_room , pres_host_teacher ,
					pres_max_capacity
					from mentor
					order by mentor.mentor_last_name';

    return get_list($query);
}

function get_students_in_ses()
{
    $query = 'SELECT usr_last_name, usr_first_name, usr_class_year
                    from pres_user_xref
                    inner join user on pres_user_xref.usr_id = user.usr_id
                    where pres_user_xref.pres_id = 257
                    order by usr_last_name, usr_first_name';
    return get_list($query);
}

function get_presentation_list()
{
    $query = 'SELECT mentor.mentor_id, mentor_last_name, mentor_first_name, mentor_position, mentor_company,
                    pres_room, pres_host_teacher, pres_max_capacity, ses_start, ses_end, ses_name, pres_enrolled_count,
                    presentation.pres_id
                    from mentor
                    inner join presentation on presentation.mentor_id = mentor.mentor_id
                    inner join session_times on session_times.ses_id = presentation.ses_id
                    where mentor.active = 1
                    and pres_id in (257, 349, 93)
                    order by session_times.sort_order, mentor.pres_host_teacher';
    return get_list($query);
}

//todo: get query to find the exact session of the exact mentor if they are both specified
//todo: get query to find a session with all the presentations if only one is specified
?>