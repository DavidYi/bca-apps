<?php

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
function get_unregistered_users(year) {
    $query = "SELECT user.usr_id, usr_bca_id, usr_first_name, usr_last_name, grade_lvl, num_sessions
    from
    (select user.usr_id, count(*) as num_sessions
    from user
    inner join pres_user_xref on pres_user_xref.usr_id = user.usr_id
    where usr_active = 1
        and usr_type_cde = 'STD'
        and 
    group by user.usr_id
    having num_sessions < 4

            union

        SELECT user.usr_id, 0 as num_sessions
    from user
    left join pres_user_xref on pres_user_xref.usr_id= user.usr_id
    where pres_user_xref.usr_id is null
        and usr_type_cde = 'STD'
        and usr_active = 1
        ) incomplete
    inner join user on user.usr_id = incomplete.usr_id
    inner join signup_dates on signup_dates.class_year= user.usr_class_year""

}

?>