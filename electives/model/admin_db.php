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
              group_concat(times.time_short_desc order by times.sort_order
              SEPARATOR ', ') as mods_available
 
              from user u left join (
                  select x.usr_id, t.time_short_desc, t.sort_order
                  from elect_user_free_xref x, elect_time t
                  where x.time_id = t.time_id
                  ) as times 
                  on u.usr_id = times.usr_id
                
              where u.usr_type_cde = 'TCH'
              group by u.usr_id
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

function admin_get_teachers() {
    $query = "select user.usr_id, concat(usr_first_name, ' ', usr_last_name) as name
              from user
              where usr_type_cde = 'TCH'
              order by usr_last_name";

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

function get_elective_list($order_by = null) {
    $query = "select concat(u.usr_first_name, ' ', u.usr_last_name) as teacher_name, e.course_name, e.course_desc, count(x.usr_id) as num_students
            from user u, elect_course e 
            left join elect_student_course_xref x on e.course_id = x.course_id
            where e.teacher_id = u.usr_id
            group by e.course_id";

    if ($order_by == null) {
        $query .= " order by u.usr_last_name";
    } else if ($order_by == 2) {
        $query .= " order by count(x.usr_id) desc";
    } else {
        $query .= " order by e.course_name";
    }

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