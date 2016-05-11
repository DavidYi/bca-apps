<?php
/**
 * Created by PhpStorm.
 * User: Eric
 * Date: 5/11/2016
 * Time: 9:22 AM
 */
function get_presentation_list(){
    $query = 'SELECT ses_name, presentation.pres_id, pres_title, pres_desc, organization, location, presentation.rm_id, field_name,
                    pres_max_teachers, pres_max_students, pres_enrolled_teachers, pres_enrolled_students,
                    pres_max_students - presentation.pres_enrolled_students as remaining, 
                    get_presenters_comma_list (presentation.pres_id) presenter_names,
                    rm_nbr, ses_start, ses_end
                FROM presentation, field, room, session_times 
                WHERE presentation.field_id = field.field_id
                    and presentation.rm_id = room.rm_id
                    and presentation.ses_id = session_times.ses_id';

    return get_list($query);
}

function get_students_in_ses($pres_id)
{
    $query = 'SELECT usr_last_name, usr_first_name, usr_class_year, academy_cde
                    from pres_user_xref
                    inner join user on pres_user_xref.usr_id = user.usr_id
                    where pres_user_xref.pres_id = :pres_id
                    order by usr_last_name, usr_first_name';

    return get_list($query);
}