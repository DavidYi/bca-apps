<?php

function get_course_signup_matrix_heading($course_id) {
    global $user;
    global $db;
    global $app_cde;

    $query =
        'select t.time_id, time_short_desc, count(*) as cnt
        from elect_course c, elect_student_course_xref sc, elect_user_free_xref ta, 
              elect_time t, user u, elect_user_free_xref sa 
        where u.usr_id = sa.usr_id
        and t.time_id = sa.time_id
        and sc.usr_id = u.usr_id
        and c.course_id = sc.course_id
        and c.teacher_id = ta.usr_id
        and ta.time_id =t.time_id
        and c.course_id = :course_id 
        group by t.time_id
        having count(*) > 0
        order by time_id, time_short_desc';

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':course_id', $course_id);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

function get_course_signup_matrix_body($course_id) {
    global $user;
    global $db;
    global $app_cde;

    $query =
        'SELECT time_short_desc, ut.usr_id, usr_last_name, usr_first_name, IF(sa.usr_id IS NULL, \' \', \'X\') as mark
        FROM elect_course c, elect_student_course_xref sc,      
            (SELECT t.time_id, count(*)
                    FROM elect_course c, elect_student_course_xref sc, elect_user_free_xref ta, elect_time t, 
                          user u, elect_user_free_xref sa 
                    WHERE u.usr_id = sa.usr_id
                    AND t.time_id = sa.time_id
                    AND sc.usr_id = u.usr_id
                    AND c.course_id = sc.course_id
                    AND c.teacher_id = ta.usr_id
                    AND ta.time_id =t.time_id
                    and c.course_id = :course_id 
                    GROUP BY t.time_id
                    HAVING count(*) > 0
                    ORDER BY c.course_id, course_name, time_id, time_short_desc) valid_times,
            (SELECT time_id, time_short_desc, sort_order, usr_id, usr_last_name, usr_first_name FROM user, elect_time) ut

        LEFT JOIN elect_user_free_xref sa 
          ON ut.usr_id = sa.usr_id
          AND ut.time_id = sa.time_id
        
        WHERE sc.usr_id = ut.usr_id
        AND c.course_id = sc.course_id
        AND valid_times.time_id = ut.time_id
        AND c.course_id = :course_id
        ORDER BY usr_last_name, usr_first_name, sort_order';

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':course_id', $course_id);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

function get_course_by_course_id($course_id) {
    $query = "SELECT c.course_id, course_name, course_desc, teacher_id, CONCAT(u.usr_last_name, ', ', u.usr_first_name) as name
              FROM elect_course c, user u
              WHERE c.teacher_id = u.usr_id
              and course_id = :course_id";

    global $db;

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


// function needs teacher id
function  add_trip($trip_name, $destination, $num_students, $start_date, $start_time, $end_date, $end_time, $usr_id, $purpose) {
    $query = "INSERT INTO trip (title, destination, num_students, start_date, start_time, end_date, end_time, lead_teacher_id, purpose) 
    VALUES (:trip_name, :destination, :num_students, :start_date, :start_time, :end_date, :end_time, :usr_id, :purpose)";

    global $db;

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':trip_name', $trip_name);
        $statement->bindValue(':destination', $destination);
        $statement->bindValue(':num_students', $num_students);
        $statement->bindValue(':start_date', $start_date);
        $statement->bindValue(':start_time', $start_time);
        $statement->bindValue(':end_date', $end_date);
        $statement->bindValue(':end_time', $end_time);
        $statement->bindValue(':usr_id', $usr_id);
        $statement->bindValue(':purpose', $purpose);
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

function get_trip_by_user($usr_id) {
    $query = 'SELECT trip_id, title, start_date, destination
            from trip
            where lead_teacher_id = :usr_id';

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
            and active = 1";

    // add order by clause
    if ($sort_by == 1) $query .= "ORDER BY course_name ";
    elseif ($sort_by == 2) $query .= "ORDER BY teacher ";
    elseif ($sort_by == 3) $query .= "ORDER BY enrolled ";

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

function edit_course($course_id, $new_course_name, $new_course_desc, $active) {
    global $db;
    $query = "UPDATE elect_course
    SET course_name = :new_course_name, course_desc = :new_course_desc, active = :active
    WHERE course_id = :course_id";

    try {

        $statement = $db->prepare($query);
        $statement->bindValue(':new_course_name', $new_course_name);
        $statement->bindValue(':new_course_desc', $new_course_desc);
        $statement->bindValue(':course_id', $course_id);
        $statement->bindValue(':active', $active);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

?>