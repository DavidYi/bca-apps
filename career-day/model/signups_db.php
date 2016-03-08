<?php

function get_teachers() {
    $query = 'SELECT teacher_id, last_name, first_name, display_name
                from teacher
                where active = 1
                order by display_name';
    return get_list($query);
}

function get_course_types() {
    $query = 'SELECT course_type_cde, course_type_desc, sort_order
                from course_type
                order by sort_order';

    return get_list($query);
}


function get_signup_dates_list() {
    $query = 'SELECT signup_dates.class_year, class_year, start, end,
                    GET_SCHEDULE_TIMES_LIST (signup_dates.class_year) as times
                from signup_dates
                inner join course_type
                on course.course_type_cde = course_type.course_type_cde
                inner join teacher
                on course.teacher_id = teacher.teacher_id
                where course.active = 1
                order by course.course_nbr';
    return get_list($query);
}

function get_signup_dates_by_grade($grade_lvl) {
    $query = 'SELECT start, end
              FROM signup_dates
              WHERE grade_lvl = :grade_lvl';

    global $db;

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':grade_lvl', $grade_lvl);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

function add_signup_dates($class_year, $start, $end) {
    global $db;
    $query = 'INSERT INTO signup_dates
                 (class_year, start, end)
              VALUES
                 (:class_year, :start, :end)';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':course_name', $course_name);
        $statement->bindValue(':course_short_name', $course_short_name);
        $statement->bindValue(':course_desc', $course_desc);
        $statement->bindValue(':teacher_id', $teacher_id);
        $statement->bindValue(':course_nbr', $course_nbr);
        $statement->bindValue(':room', $room);
        $statement->bindValue(':course_type_cde', $course_type_cde);

        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

function modify_course($course_id, $course_name, $course_short_name, $course_desc,
                       $teacher_id, $course_nbr, $room, $course_type_cde) {
    global $db;
    $query = '  update course
                set course_name = :course_name,
                     course_short_name = :course_short_name,
                     course_desc = :course_desc,
                     teacher_id = :teacher_id,
                     course_nbr = :course_nbr,
                     room = :room,
                     course_type_cde = :course_type_cde
                where course_id = :course_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':course_id', $course_id);
        $statement->bindValue(':course_name', $course_name);
        $statement->bindValue(':course_short_name', $course_short_name);
        $statement->bindValue(':course_desc', $course_desc);
        $statement->bindValue(':teacher_id', $teacher_id);
        $statement->bindValue(':course_nbr', $course_nbr);
        $statement->bindValue(':room', $room);
        $statement->bindValue(':course_type_cde', $course_type_cde);

        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

function delete_course($course_id) {
    global $db;
    $query = 'update course set active = 0 where course_id = :course_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':course_id', $course_id);

        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

function get_course($course_id) {
    global $db;
    $query = 'SELECT course_id, course_name, course_nbr, course_short_name,
                course_desc, teacher_id, course_type_cde, room
              from course
              where course_id = :course_id
              order by course_nbr';

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':course_id', $course_id);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}


?>