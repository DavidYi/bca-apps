<?php
/**
 * Created by PhpStorm.
 * User: matth
 * Date: 7/27/2016
 * Time: 10:58 AM
 */
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