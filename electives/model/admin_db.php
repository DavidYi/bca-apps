<?php
/**
 * Created by PhpStorm.
 * User: matth
 * Date: 7/27/2016
 * Time: 10:58 AM
 */

function get_free_mods()
{
    global $db;

    $query = "select u.usr_id, u.usr_first_name, u.usr_last_name,
			monday.mods as mon, tuesday.mods as tues, wednesday.mods as weds, 
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

function admin_get_teachers()
{
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

function get_elective_list($order_by = null)
{
    $query = "select e.course_id, concat(u.usr_first_name, ' ', u.usr_last_name) as teacher_name, e.course_name, e.course_desc, count(x.usr_id) as num_students
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

function get_best_course_availability()
{
    $query = "select ec.course_id, course_name, time_short_desc, count(*) as students
                from elect_course ec, elect_time et, elect_user_free_xref eu, elect_user_free_xref ex, elect_student_course_xref escx
                where ec.course_id = escx.course_id
                and et.time_id = eu.time_id
                and escx.usr_id = eu.usr_id
                and ec.teacher_id = ex.usr_id
                and ex.time_id = eu.time_id
                group by ec.course_id, et.time_id
                having count(*) > 1
                order by ec.course_name, count(*) desc";

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


function admin_edit_course($course_id, $teacher_id, $course_name, $course_desc)
{
    $query = "UPDATE elect_course
            SET course_name = :name, course_desc = :desc, teacher_id = :teacher_id
            WHERE course_id = :id;";

    global $db;

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':name', $course_name);
        $statement->bindValue(':desc', $course_desc);
        $statement->bindValue(':id', $course_id);
        $statement->bindValue(':teacher_id', $teacher_id);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

function get_course_info($course_id)
{
    $query = "select e.course_id, e.course_name, e.course_desc, e.teacher_id
    from elect_course e, user u
    where e.teacher_id = u.usr_id
    and e.course_id = :id";

}


function get_best_course_availability_students($course_id, $time_id)
{
    $query = "select u.usr_first_name, u.usr_last_name, u.usr_grade_lvl
	from elect_course ec, elect_time et, elect_user_free_xref eu, elect_student_course_xref escx, user u
	where ec.course_id = :course_id
	and ec.course_id = escx.course_id
	and et.time_id = :time_id
	and et.time_id = eu.time_id
	and u.usr_id = escx.usr_id
	and escx.usr_id = eu.usr_id
	order by ec.course_name, count(*) desc";


    global $db;

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':course_id', $course_id);
        $statement->bindValue(':time_id', $time_id);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();

        return $result;
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

//These will affect all rows
//TODO: Add undo button or something

function clear_student_availability()
{
    global $db;
    $query = "delete * from elect_user_free_xref"; //Something to verify if student
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

function clear_student_interest()
{
    global $db;
    $query = "delete * from elect_student_course_xref"; //Something to verify if student
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

function clear_teacher_availability()
{
    global $db;
    $query = "delete * from elect_user_free_xref"; //Something to verify if teacher
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

function clear_all_courses()
{
    global $db;
    $query = "delete * from elect_course";
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}