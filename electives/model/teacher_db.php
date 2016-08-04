<?php
/**
 * Created by PhpStorm.
 * User: matth
 * Date: 4/20/2016
 * Time: 10:31 AM
 */

// function needs teacher id
function add_course($course_name, $course_desc, $usr_id) {
    $query = "INSERT INTO elect_course (course_name, course_desc, teacher_id) 
    VALUES (:course_name, :course_desc, :user_id)";

    global $db;

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':course_name', $course_name);
        $statement->bindValue(':course_desc', $course_desc);
        $statement->bindValue(':user_id', $usr_id);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}
//
function delete_course($course_id) {
    global $db;

    $db->beginTransaction();

    try {
        $query1 = "delete from elect_student_course_xref 
              where course_id = :course_id";
        $statement = $db->prepare($query1);
        $statement->bindValue(':course_id', $course_id);
        $statement->execute();
        $statement->closeCursor();

        $query2 = "delete from elect_course 
              where course_id = :course_id";
        $statement = $db->prepare($query2);
        $statement->bindValue(':course_id', $course_id);
        $statement->execute();
        $statement->closeCursor();

        // commit transaction
        $db->commit();

    } catch (PDOException $e) {
        $db->rollback();
        display_db_exception($e);
        exit();
    }

}

function get_course_by_user($usr_id) {
    $query = 'SELECT course_id, course_name, course_desc, teacher_id
              FROM elect_course
              WHERE teacher_id = :usr_id';

    global $db;

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':usr_id', $usr_id);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

// returns all of the courses available and whether or not the student is enrolled in each one
function get_course_list_for_student ($usr_id, $sort_by, $sort_order) {

    $query = "SELECT c.course_id, course_name, course_desc, concat(u.usr_last_name, ', ', u.usr_first_name) AS teacher,
            !isnull(x.usr_id) AS enrolled
            FROM user u, elect_course c
            LEFT JOIN elect_student_course_xref x ON c.course_id = x.course_id AND x.usr_id = :usr_id
            WHERE c.teacher_id = u.usr_id
            ORDER BY ";

    // add order by clause
    if ($sort_by == 1) $query .= "course_name ";
    elseif ($sort_by == 2) $query .= "teacher ";
    elseif ($sort_by == 3) $query .= "enrolled ";

    if ($sort_order == 2) $query .= "DESC";

    global $db;

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':usr_id', $usr_id);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

function edit_course($course_id, $new_course_name, $new_course_desc) {
    global $db;
    echo $course_id;
    echo $new_course_desc;
    echo $new_course_name;

    $query = "UPDATE elect_course
    SET course_name = :new_course_name, course_desc = :new_course_desc
    WHERE course_id = :course_id";

    try {

        $statement = $db->prepare($query);
        $statement->bindValue(':new_course_name', $new_course_name);
        $statement->bindValue(':new_course_desc', $new_course_desc);
        $statement->bindValue(':course_id', $course_id);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

?>