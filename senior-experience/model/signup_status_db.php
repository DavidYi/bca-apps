<?php

function get_registered_users(){

    $query = 'SELECT completed.usr_grade_lvl, completed.num AS Complete, partial.num AS Partial, none.num AS None
    FROM
    (SELECT usr_grade_lvl, sum(num) AS num
    FROM
    (SELECT distinct grade_lvl as usr_grade_lvl, 0 AS num
    FROM signup_dates

    UNION

    SELECT usr_grade_lvl, count(*) AS num
    FROM (
    SELECT usr_grade_lvl, user.usr_id, count(*) AS num_sessions
    FROM user 
    INNER JOIN user_presentation_xref ON user_presentation_xref.usr_id = user.usr_id
    WHERE usr_active = 1
    GROUP BY usr_grade_lvl, user.usr_id
    HAVING num_sessions = 4
    ) temp
    GROUP BY usr_grade_lvl ) a

    GROUP BY usr_grade_lvl) completed

    INNER JOIN (
    SELECT usr_grade_lvl, sum(num) AS num
    FROM
    (SELECT distinct grade_lvl as usr_grade_lvl, 0 AS num
    FROM signup_dates

    UNION
    SELECT usr_grade_lvl, count(*) AS num
    FROM (
    SELECT usr_grade_lvl, user.usr_id, count(*) AS num_sessions
    FROM user 
    INNER JOIN user_presentation_xref ON user_presentation_xref.usr_id = user.usr_id
    WHERE usr_active = 1
    GROUP BY usr_grade_lvl, user.usr_id
    HAVING num_sessions < 4
    ) temp
    GROUP BY usr_grade_lvl
     ) a

    GROUP BY usr_grade_lvl

    ) partial ON completed.usr_grade_lvl = partial.usr_grade_lvl



    INNER JOIN (
    SELECT usr_grade_lvl, sum(num) AS num
    FROM
    (SELECT distinct grade_lvl as usr_grade_lvl, 0 AS num
    FROM signup_dates

    UNION
    SELECT usr_grade_lvl, count(*) AS num
    FROM user
    LEFT JOIN user_presentation_xref ON user_presentation_xref.usr_id= user.usr_id
    WHERE user_presentation_xref.usr_id IS NULL
    AND usr_active = 1
    GROUP BY usr_grade_lvl
    ) a

    GROUP BY usr_grade_lvl

    ) none ON completed.usr_grade_lvl = none.usr_grade_lvl
    ORDER BY usr_grade_lvl;';
    return get_list($query);
}
function undo_enroll($year) {
    $query = "delete from user_presentation_xref
    where usr_id in (
      SELECT usr_id
      FROM user
      WHERE usr_grade_lvl = :year
    )
    AND user_pres_updt_usr_id = -1
    and presenting = 0";
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


function presentations_registration_status() {
    $query =
        'select p.ses_id, rm_nbr, field_name, pres_title, organization, location, 
                p.pres_desc, get_full_name_presenters_comma_list(p.pres_id),
                pres_enrolled_students, pres_max_students, pres_max_students - pres_enrolled_students,
                pres_enrolled_teachers, pres_max_teachers, pres_max_teachers - pres_enrolled_teachers
        from presentation p, room r, field f
        where p.rm_id = r.rm_id
        and p.field_id = f.field_id
        order by ses_id, field_name ';

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


function all_registrants_download() {
    $query =
        ' select usr_last_name, usr_first_name, usr_grade_lvl, ses_id, rm_nbr, field_name, pres_title, organization, location, presenting, p.pres_id, p.field_id, u.usr_id
            from user u, user_presentation_xref x, presentation p, room r, field f
            where u.usr_id = x.usr_id
            and p.pres_id = x.pres_id
            and p.rm_id = r.rm_id
            and p.field_id = f.field_id
            order by usr_last_name, usr_first_name ';

    return get_csv_list($query, 0);
}

function all_enroll_download($grade) {
    $gradeClause = '';
    if ($grade != 0) {
        $gradeClause = ' and usr_grade_lvl = :usr_grade_lvl';
    }
    $query =
        ' select usr_last_name, usr_first_name, usr_bca_id, usr_class_year, num_sessions
    from (
        SELECT grade_lvl, u.usr_id, count(*) as num_sessions
			from signup_dates d, user u, user_presentation_xref x  
			where u.usr_grade_lvl = d.grade_lvl
			and x.usr_id = u.usr_id
			and usr_active = 1
			group by grade_lvl, u.usr_id
			having num_sessions = 4
         ) temp, user
    where user.usr_id = temp.usr_id 
    ' . $gradeClause . '
    order by usr_last_name, usr_first_name ';

    return get_csv_list($query, $grade);
}

function partial_enroll_download($grade) {
    $gradeClause = '';
    if ($grade != 0) {
        $gradeClause = ' and usr_grade_lvl = :usr_grade_lvl ';
    }
    $query =
        ' select usr_last_name, usr_first_name, usr_bca_id, usr_class_year, num_sessions
    from (
        SELECT grade_lvl, u.usr_id, count(*) as num_sessions
			from signup_dates d, user u, user_presentation_xref x  
			where u.usr_grade_lvl = d.grade_lvl
			and x.usr_id = u.usr_id
			and usr_active = 1
			group by grade_lvl, u.usr_id
			having num_sessions < 4
         ) temp, user
    where user.usr_id = temp.usr_id 
    ' . $gradeClause . '
    order by usr_last_name, usr_first_name ';

    return get_csv_list($query, $grade);
}

function no_enroll_download($grade) {
    $gradeClause = '';
    if ($grade != 0) {
        $gradeClause = ' and usr_grade_lvl = :usr_grade_lvl';
    }
    $query = 'select usr_last_name, usr_first_name, usr_bca_id, usr_class_year
    from (
        SELECT u.usr_id
		from signup_dates d, user u  
		LEFT JOIN user_presentation_xref x  ON x.usr_id= u.usr_id
		WHERE x.usr_id IS NULL
		and u.usr_grade_lvl = d.grade_lvl
		and usr_active = 1
	 ) temp, user
    where user.usr_id = temp.usr_id 
    ' . $gradeClause . '
    order by usr_last_name, usr_first_name';

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