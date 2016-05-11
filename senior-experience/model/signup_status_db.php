<?php

function get_registered_users(){
    $query = 'SELECT completed.grade_lvl, completed.num AS Complete, partial.num AS Partial, none.num AS None
    FROM
    (SELECT grade_lvl, sum(num) AS num
    FROM
    (SELECT grade_lvl, 0 AS num
    FROM signup_dates

    UNION

    SELECT grade_lvl, count(*) AS num
    FROM (
    SELECT grade_lvl, user.usr_id, count(*) AS num_sessions
    FROM signup_dates
    INNER JOIN user ON user.usr_grade_lvl = signup_dates.grade_lvl
    INNER JOIN user_presentation_xref ON user_presentation_xref.usr_id = user.usr_id
    WHERE usr_active = 1
    AND usr_type_cde = \'STD\'
    GROUP BY grade_lvl, user.usr_id
    HAVING num_sessions = 4
    ) temp
    GROUP BY grade_lvl ) a

    GROUP BY grade_lvl) completed

    INNER JOIN (
    SELECT grade_lvl, sum(num) AS num
    FROM
    (SELECT grade_lvl, 0 AS num
    FROM signup_dates

    UNION
    SELECT grade_lvl, count(*) AS num
    FROM (
    SELECT grade_lvl, user.usr_id, count(*) AS num_sessions
    FROM signup_dates
    INNER JOIN user ON user.usr_grade_lvl = signup_dates.grade_lvl
    INNER JOIN user_presentation_xref ON user_presentation_xref.usr_id = user.usr_id
    WHERE usr_active = 1
    AND usr_type_cde = \'STD\'
    GROUP BY grade_lvl, user.usr_id
    HAVING num_sessions < 4
    ) temp
    GROUP BY grade_lvl
     ) a

    GROUP BY grade_lvl

    ) partial ON completed.grade_lvl = partial.grade_lvl



    INNER JOIN (
    SELECT grade_lvl, sum(num) AS num
    FROM
    (SELECT grade_lvl, 0 AS num
    FROM signup_dates

    UNION
    SELECT grade_lvl, count(*) AS num
    FROM user
    INNER JOIN signup_dates ON signup_dates.grade_lvl = user.usr_grade_lvl
    LEFT JOIN user_presentation_xref ON user_presentation_xref.usr_id= user.usr_id
    WHERE user_presentation_xref.usr_id IS NULL
    AND usr_type_cde = \'STD\'
    AND usr_active = 1
    GROUP BY grade_lvl
    ) a

    GROUP BY grade_lvl

    ) none ON completed.grade_lvl = none.grade_lvl
    ORDER BY grade_lvl;';
    return get_list($query);
}
function undo_enroll($year) {
    $query = "delete from pres_user_xref
    where usr_id in (
      SELECT usr_id
      FROM user
        INNER JOIN signup_dates ON user.usr_class_year = signup_dates.class_year
      WHERE grade_lvl = :year
    )
    AND pres_user_updt_usr_id = -1";
    global $db;

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':year', $year);
        $statement->execute();
        $statement->closeCursor();
        return;
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

function random_enroll($year) {
    $query = 'CALL fill_with_random_presentations(:year)';
    global $db;

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':year', $year);
        $statement->execute();
        $statement->closeCursor();
        return;
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
             inner join user on user.usr_class_year = signup_dates.class_year
             inner join pres_user_xref on pres_user_xref.usr_id = user.usr_id
           where usr_active = 1
    and usr_type_cde = \'STD\'
           group by grade_lvl, user.usr_id
           having num_sessions = 4
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
             inner join user on user.usr_class_year = signup_dates.class_year
             inner join pres_user_xref on pres_user_xref.usr_id = user.usr_id
           where usr_active = 1
    and usr_type_cde = \'STD\'
           group by grade_lvl, user.usr_id
           having num_sessions <4
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
             INNER JOIN signup_dates ON signup_dates.class_year= user.usr_class_year
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