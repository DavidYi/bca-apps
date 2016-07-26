<?php
/**
 * Created by PhpStorm.
 * User: daviyi
 * Date: 12/18/2015
 * Time: 1:45 PM
 */
require_once "database.php";

function get_session_times()
{
    $query = 'SELECT ses_id, ses_name, ses_start, ses_end
					from session_times
					order by sort_order';

    return get_list($query);
}

function get_session_times_by_id($ses_id)
{
    $query = 'SELECT ses_name, ses_start, ses_end
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
        display_db_exception($e);
        exit();
    }
}

function get_rooms(){
    $query = 'select distinct rm_nbr, p.rm_id
                from presentation p, room r
                where p.rm_id = r.rm_id
                order by r.rm_nbr;';

    return get_list($query);
}


function get_session_by_room($rm_id, $ses_id){
    $query = 'select p.ses_id, org_name, presenter_names, ses_start_time, wkshp_nme
                from presentation p, session_times s, workshop w
                where p.ses_id = s.ses_id
                and p.wkshp_id = w.wkshp_id
                and rm_id  = :rm_id
                and p.ses_id = :ses_id';

    global $db;
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':rm_id', $rm_id);
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

function get_presentation_list(){
    $query = 'SELECT workshop.wkshp_nme, presentation.pres_id, presentation.org_name, presentation.rm_id,
                    pres_max_teachers, pres_max_seats, pres_enrolled_teachers, pres_enrolled_seats,
                    pres_max_seats - presentation.pres_enrolled_seats as remaining, 
                    presenter_names, rm_nbr, ses_start_time, ses_end_time, presentation.ses_id, presentation.wkshp_id
                FROM presentation, room, session_times, workshop 
                WHERE presentation.rm_id = room.rm_id
                    and presentation.ses_id = session_times.ses_id
                    and presentation.wkshp_id = workshop.wkshp_id
                    
                order by rm_nbr, presentation.ses_id ';

    return get_list($query);
}
function get_presenters_in_ses($pres_id)
{
    $query = "select p.presenter_names as presenters
                from pres_user_xref x, user u, presentation p
                where x.usr_id = u.usr_id
                and x.pres_id = p.pres_id
                and x.pres_id = :pres_id";

    global $db;

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':pres_id', $pres_id);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result['presenters'];
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

function get_teachers_in_ses($pres_id)
{
    $query = "select GROUP_CONCAT( concat (usr_first_name, ' ', usr_last_name) order by usr_last_name SEPARATOR ', ') as teachers
                from pres_user_xref x, user u, presentation p
                where x.usr_id = u.usr_id
                and x.pres_id = p.pres_id
                and u.usr_type_cde = 'TCH'
                and x.pres_id = :pres_id";

    global $db;

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':pres_id', $pres_id);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result['teachers'];
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}
function get_students_in_ses($pres_id)
{
    $query = 'SELECT usr_last_name, usr_first_name, usr_grade_lvl, academy_cde
                    from pres_user_xref x, user u
                    where x.usr_id = u.usr_id
                    and x.pres_id = :pres_id
                    and usr_grade_lvl != 13
                    order by usr_last_name, usr_first_name';

    global $db;

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':pres_id', $pres_id);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}
/*function get_presentation_list($mentor_id, $ses_id)
{
    $query = 'SELECT mentor.mentor_id, mentor_last_name, mentor_first_name, mentor_position, mentor_company,
                    pres_room, pres_host_teacher, pres_max_capacity, ses_start, ses_end, ses_name, pres_enrolled_count,
                    presentation.pres_id
                    from mentor
                    inner join presentation on presentation.mentor_id = mentor.mentor_id
                    inner join session_times on session_times.ses_id = presentation.ses_id
                    where mentor.active = 1';

    if ($mentor_id != 'All')
        $query .= " and mentor.mentor_id = :mentor_id";

    if ($ses_id != 'All')
        $query .= " and presentation.ses_id= :ses_id";

    $query .= " order by mentor_last_name, mentor_first_name, session_times.sort_order";

    global $db;

    try {
        $statement = $db->prepare($query);

        if ($mentor_id != 'All')
            $statement->bindValue(':mentor_id', $mentor_id);

        if ($ses_id != 'All')
            $statement->bindValue(':ses_id', $ses_id);

        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}*/

?>