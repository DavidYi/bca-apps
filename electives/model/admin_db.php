<?php
/**
 * Created by PhpStorm.
 * User: matth
 * Date: 7/27/2016
 * Time: 10:58 AM
 */

function get_free_mods() {
    global $db;

    $query = "select u.usr_id, u.usr_first_name, u.usr_last_name,
			monday.mods as mon, tuesday.mods as tues, wednesday.mods as wed, 
            thursday.mods as thurs, friday.mods as fri
  
              from user u 
              
              left join (
                  select x.usr_id, day_short, day, 
					group_concat(mods order by t.sort_order SEPARATOR ', ') as mods
                  from elect_user_free_xref x, elect_time t
                  where x.time_id = t.time_id
                  and day_short = 'M'
                  group by x.usr_id
                  ) as monday 
                  on u.usr_id = monday.usr_id


              left join (
                  select x.usr_id, day_short, day, 
					group_concat(mods order by t.sort_order SEPARATOR ', ') as mods
                  from elect_user_free_xref x, elect_time t
                  where x.time_id = t.time_id
                  and day_short = 'T'
                  group by x.usr_id
                  ) as tuesday
                  on u.usr_id = tuesday.usr_id

             left join (
                  select x.usr_id, day_short, day, 
					group_concat(mods order by t.sort_order SEPARATOR ', ') as mods
                  from elect_user_free_xref x, elect_time t
                  where x.time_id = t.time_id
                  and day_short = 'W'
                  group by x.usr_id
                  ) as wednesday
                  on u.usr_id = wednesday.usr_id
                  
				left join (
                  select x.usr_id, day_short, day, 
					group_concat(mods order by t.sort_order SEPARATOR ', ') as mods
                  from elect_user_free_xref x, elect_time t
                  where x.time_id = t.time_id
                  and day_short = 'R'
                  group by x.usr_id
                  ) as thursday
                  on u.usr_id = thursday.usr_id 
                  
				left join (
                  select x.usr_id, day_short, day, 
					group_concat(mods order by t.sort_order SEPARATOR ', ') as mods
                  from elect_user_free_xref x, elect_time t
                  where x.time_id = t.time_id
                  and day_short = 'F'
                  group by x.usr_id
                  ) as friday
                  on u.usr_id = friday.usr_id
                where u.usr_type_cde = 'TCH'
                order by u.usr_last_name";

        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();

            return $result;
        } catch (PDOException $e) {
            display_db_exception($e);
            exit();
        }
}
function get_elective_list() {
    $query = "select concat(t.usr_first_name, ' ', t.usr_last_name) as teacher_name, e.course_name, e.course_desc, count(*) as num_students
            from user t, elect_course e, elect_student_course_xref x
            where t.usr_type_cde = 'TCH'
                and e.course_id = x.course_id
                and t.usr_id = e.teacher_id
            group by teacher_name
            order by t.usr_last_name;";

    global $db;

    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();

        return $result;
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}