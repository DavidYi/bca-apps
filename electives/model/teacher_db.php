<?php
/**
 * Created by PhpStorm.
 * User: matth
 * Date: 4/20/2016
 * Time: 10:31 AM
 */

// function needs teacher id
function add_course($course_name, $course_desc) {
    $query = "INSERT INTO elect_course (course_name, course_desc, teacher_id) 
    VALUES (:course_name, :course_desc, :user_id)";

    global $db;
    global $user;

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':course_name', $course_name);
        $statement->bindValue(':course_desc', $course_desc);
        $statement->bindValue(':user_id', $user->usr_id);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
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

function get_course_list_for_student ($usr_id) {
    $query = "select c.course_id, course_name, course_desc, concat(u.usr_last_name, ', ', u.usr_first_name) as teacher,
            !isnull(x.usr_id) as enrolled
            from user u, elect_course c
            left join elect_student_course_xref x on c.course_id = x.course_id and x.usr_id = 1
            where c.teacher_id = u.usr_id
            order by course_name";

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