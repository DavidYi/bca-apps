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
                    rm_nbr, ses_start, ses_end, presentation.ses_id
                FROM presentation, field, room, session_times 
                WHERE presentation.field_id = field.field_id
                    and presentation.rm_id = room.rm_id
                    and presentation.ses_id = session_times.ses_id
                order by rm_nbr, presentation.ses_id ';

    return get_list($query);
}

function get_presenters_in_ses($pres_id)
{
    $query = "select GROUP_CONCAT( concat (usr_first_name, ' ', usr_last_name) order by usr_last_name SEPARATOR ', ') as presenters
                from user_presentation_xref x, user u, presentation p
                where x.usr_id = u.usr_id
                and x.pres_id = p.pres_id
                and x.presenting = 1
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
                from user_presentation_xref x, user u, presentation p
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
                    from user_presentation_xref x, user u
                    where x.usr_id = u.usr_id
                    and x.pres_id = :pres_id
                    and presenting = 0
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
function get_rooms(){
    $query = 'select distinct rm_nbr, p.rm_id
                from presentation p, room r
                where p.rm_id = r.rm_id
                order by r.rm_nbr;';

    return get_list($query);
}

function get_session_by_room($rm_id, $ses_id){
    $query = 'select p.ses_id, pres_title, organization, get_full_name_presenters_comma_list (p.pres_id) full_presenters, ses_start
                from presentation p, session_times s
                where p.ses_id = s.ses_id
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