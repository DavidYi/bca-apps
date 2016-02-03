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
    inner join user on user.usr_class_year = signup_dates.class_year
    inner join pres_user_xref on pres_user_xref.usr_id = user.usr_id
    where usr_active = 1
    and usr_type_cde = \'STD\'
    group by grade_lvl, user.usr_id
    having num_sessions = 4
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
    inner join user on user.usr_class_year = signup_dates.class_year
    inner join pres_user_xref on pres_user_xref.usr_id = user.usr_id
    where usr_active = 1
    and usr_type_cde = \'STD\'
    group by grade_lvl, user.usr_id
    having num_sessions < 4
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
    inner join signup_dates on signup_dates.class_year= user.usr_class_year
    left join pres_user_xref on pres_user_xref.usr_id= user.usr_id
    where pres_user_xref.usr_id is null
    and usr_type_cde = \'STD\'
    and usr_active = 1
    group by grade_lvl
    ) a

    group by grade_lvl

    ) none on completed.grade_lvl = none.grade_lvl
    order by grade_lvl';
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
        $error_message = $e->getMessage();
        display_db_error($error_message);
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
        $error_message = $e->getMessage();
        display_db_error($error_message);
        exit();
    }
}

function all_enroll_download() {
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
    inner join user on user.usr_id = temp.usr_id
    order by usr_last_name, usr_first_name';

    return get_csv_list($query);
}

function partial_enroll_download() {
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
    inner join user on user.usr_id = temp.usr_id
    order by usr_last_name, usr_first_name';

    return get_csv_list($query);
}

function no_enroll_download() {
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
    INNER JOIN user ON user.usr_id = temp.usr_id
    ORDER BY usr_last_name, usr_first_name';

    return get_csv_list($query);
}

function mentor_download() {
    $query = 'select mentor_last_name, mentor_first_name, mentor_field, mentor_position, mentor_company, pres_room, pres_host_teacher, ses_id, pres_max_capacity, pres_enrolled_count, pres_max_capacity - pres_enrolled_count as remaining
    from mentor, presentation
    where mentor.mentor_id = presentation.mentor_id
    and active = 1
    order by mentor_last_name, mentor_first_name';
    return get_csv_list($query);
}

function get_csv_list($query)
{
    global $db;

    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

    ?>