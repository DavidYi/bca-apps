<?php

function get_registered_users(){
    $query = 'select completed.grade_lvl, completed.num as Complete, partial.num as Partial, none.num as None
    from
    (select grade_lvl, sum(num) as num
    from
    (select grade_lvl, 0 as num
    from signup_dates

    union

    select grade_lvl, count(*) as num
    from (
    SELECT grade_lvl, user.usr_id, count(*) as num_sessions
    from signup_dates
    inner join user on user.usr_grade_lvl = signup_dates.grade_lvl
    inner join pres_user_xref on pres_user_xref.usr_id = user.usr_id
    where usr_active = 1
    and usr_type_cde in (\'STD\',\'TCH\')
    group by grade_lvl, user.usr_id
    having num_sessions = 2
    ) temp
    group by grade_lvl ) a

    group by grade_lvl) completed

    inner join (
    select grade_lvl, sum(num) as num
    from
    (select grade_lvl, 0 as num
    from signup_dates

    union
    select grade_lvl, count(*) as num
    from (
    SELECT grade_lvl, user.usr_id, count(*) as num_sessions
    from signup_dates
    inner join user on user.usr_grade_lvl = signup_dates.grade_lvl
    inner join pres_user_xref on pres_user_xref.usr_id = user.usr_id
    where usr_active = 1
    and usr_type_cde in (\'STD\',\'TCH\')
    group by grade_lvl, user.usr_id
    having num_sessions < 2
    ) temp
    group by grade_lvl
     ) a

    group by grade_lvl

    ) partial on completed.grade_lvl = partial.grade_lvl



    inner join (
    select grade_lvl, sum(num) as num
    from
    (select grade_lvl, 0 as num
    from signup_dates

    union
    SELECT grade_lvl, count(*) as num
    from user
    inner join signup_dates on signup_dates.grade_lvl= user.usr_grade_lvl
    left join pres_user_xref on pres_user_xref.usr_id= user.usr_id
    where pres_user_xref.usr_id is null
    and usr_type_cde in (\'STD\',\'TCH\')
    and usr_active = 1
    group by grade_lvl
    ) a

    group by grade_lvl

    ) none on completed.grade_lvl = none.grade_lvl
    where completed.grade_lvl != 13
    order by grade_lvl';
    return get_list($query);
}
function undo_enroll($grade_lvl) {
    $query = "delete from pres_user_xref
    where usr_id in (
      SELECT usr_id
      FROM user
      where usr_grade_lvl = :grade_lvl
    )
    AND pres_user_updt_usr_id = -1";
    global $db;

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':grade_lvl', $grade_lvl);
        $statement->execute();
        $statement->closeCursor();
        return;
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}
function all_registrants_download() {
    $query =
        ' select usr_last_name, usr_first_name, usr_grade_lvl, ses_id, rm_nbr, w.wkshp_nme, org_name, presenter_names, p.pres_id, u.usr_id
            from user u, pres_user_xref x, presentation p, room r, workshop w
            where u.usr_id = x.usr_id
            and p.pres_id = x.pres_id
            and p.rm_id = r.rm_id
            and w.wkshp_id = p.wkshp_id
            order by usr_last_name, usr_first_name ';

    return get_csv_list($query, 0);
}

function random_enroll($grade_lvl) {
    $query = 'CALL fill_with_random_presentations(:gradeLvl)';
    global $db;

    try {
        $statement = $db->prepare($query);
        $statement->bindParam(':gradeLvl', $grade_lvl, PDO::PARAM_INT);
        $statement->execute();
        $statement->closeCursor();
        return;
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}
function presentations_registration_status() {
    $query =
        'select p.ses_id, rm_nbr, w.wkshp_nme, org_name, 
                w.wkshp_desc,
                pres_enrolled_seats, pres_max_seats, pres_max_seats - pres_enrolled_seats,
                pres_enrolled_teachers, pres_max_teachers, pres_max_teachers - pres_enrolled_teachers
        from presentation p, room r, workshop w
        where p.rm_id = r.rm_id
        and w.wkshp_id = p.wkshp_id
        order by ses_id ';

    global $db;

    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

function all_enroll_download($grade) {
    $gradeClause = '';
    if ($grade != 0) {
        $gradeClause = ' where usr_grade_lvl = :usr_grade_lvl';
    }
    $query = 'select usr_last_name, usr_first_name, usr_bca_id, usr_class_year, num_sessions
    from (
        SELECT grade_lvl, user.usr_id, count(*) as num_sessions
           from signup_dates
             inner join user on user.usr_grade_lvl = signup_dates.grade_lvl
             inner join pres_user_xref on pres_user_xref.usr_id = user.usr_id
           where usr_active = 1
    and usr_type_cde = \'STD\'
           group by grade_lvl, user.usr_id
           having num_sessions = 2
         ) temp
    inner join user on user.usr_id = temp.usr_id ' . $gradeClause . '
    order by usr_last_name, usr_first_name';

    return get_csv_list($query, $grade);
}

function partial_enroll_download($grade) {
    $gradeClause = '';
    if ($grade != 0) {
        $gradeClause = ' where usr_grade_lvl = :usr_grade_lvl';
    }
    $query = 'select usr_last_name, usr_first_name, usr_bca_id, usr_class_year, num_sessions
    from (
        SELECT grade_lvl, user.usr_id, count(*) as num_sessions
           from signup_dates
             inner join user on user.usr_grade_lvl = signup_dates.grade_lvl
             inner join pres_user_xref on pres_user_xref.usr_id = user.usr_id
           where usr_active = 1
    and usr_type_cde = \'STD\'
           group by grade_lvl, user.usr_id
           having num_sessions <2
         ) temp
    inner join user on user.usr_id = temp.usr_id ' . $gradeClause . '
    order by usr_last_name, usr_first_name';

    return get_csv_list($query, $grade);
}

function no_enroll_download($grade) {
    $gradeClause = '';
    if ($grade != 0) {
        $gradeClause = ' where usr_grade_lvl = :usr_grade_lvl';
    }
    $query = 'SELECT usr_last_name, usr_first_name, usr_bca_id, usr_class_year
    FROM (
        SELECT user.usr_id
           FROM user
             INNER JOIN signup_dates ON signup_dates.grade_lvl= user.usr_grade_lvl
             LEFT JOIN pres_user_xref ON pres_user_xref.usr_id= user.usr_id
           WHERE pres_user_xref.usr_id IS NULL
    AND usr_type_cde = \'STD\'
    AND usr_active = 1
         ) temp
    INNER JOIN user ON user.usr_id = temp.usr_id ' . $gradeClause . '
    ORDER BY usr_last_name, usr_first_name';

    return get_csv_list($query, $grade);
}

function mentor_download() {
    $query = 'select mentor_last_name, mentor_first_name, mentor_field, mentor_position, mentor_company, pres_room, pres_host_teacher, ses_id, pres_max_capacity, pres_enrolled_count, pres_max_capacity - pres_enrolled_count as remaining
    from mentor, presentation
    where mentor.mentor_id = presentation.mentor_id
    and active = 1
    order by mentor_last_name, mentor_first_name';
    return get_csv_list($query);
}

function get_csv_list($query, $grade = null)
{
    global $db;

    try {
        $statement = $db->prepare($query);
        if ($grade != 0) {
            $statement->bindValue(':usr_grade_lvl', $grade);
        }

        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

    ?>