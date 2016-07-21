<?php
/**
 * Created by PhpStorm.
 * User: matth
 * Date: 7/20/2016
 * Time: 10:57 AM
 */
function get_courses($id) {
    global $db;

    $query = "select x.course_id, c.course_name, c.course_desc
              from elect_student_course_xref x, elect_course c
              where x.course_id = c.course_id
              and x.usr_id = :usr_id";

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':usr_id', $id);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();

        return $result;
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

function student_add_course($usr_id, $course_id) {
    global $db;

    $query = "insert into elect_student_course_xref (usr_id, course_id, updt_usr_id)
              VALUES (:usr_id, :course_id, :usr_id)";

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':course_id', $course_id);
        $statement->bindValue(':user_id', $usr_id->usr_id);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

function student_delete_course($usr_id, $course_id) {
    global $db;
    $query = "delete from elect_student_course_xref
              where usr_id = :usr_id
              and course_id = :course_id";

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':course_id', $course_id);
        $statement->bindValue(':usr_id', $usr_id);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}