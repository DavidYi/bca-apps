<?php
/**
 * Created by PhpStorm.
 * User: matth
 * Date: 4/20/2016
 * Time: 10:31 AM
 */

// function needs teacher id
function addCourse($course_name, $course_desc) {
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
?>