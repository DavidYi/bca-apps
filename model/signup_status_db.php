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
    having num_sessions < 4
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
?>