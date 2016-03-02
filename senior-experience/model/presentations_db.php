<?php

function get_session_times() {
    $query = 	'SELECT ses_id, ses_name, ses_start, ses_end
					from session_times
					order by sort_order';

    return get_list($query);
}

function get_session_times_by_id($ses_id) {
    $query = 'SELECT ses_start, ses_end
              FROM session_times
              WHERE ses_id = :ses_id';

    global $db;

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':ses_id', $ses_id);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
        exit();
    }
}

function get_presentation_list($ses_id, $sort_by, $order_by) {
    $query =    'SELECT pres_id, f . field_name, f . field_id, pres_title,
                    pres_desc, organization, location, presenter_names,
                    pres_max_students, pres_enrolled_students,
                    pres_max_students - pres_enrolled_students as remaining
                from presentation p, field f
                where p . field_id = f . field_id
                and ses_id = 1
                and pres_enrolled_students < pres_max_students
                order by pres_title';

    if ($sort_by == 1) $query .= ('ORDER BY f . field_name');
    else if ($sort_by == 2) $query .= ('ORDER BY pres_title');
    else if ($sort_by == 3) $query .= ('ORDER BY organization');
    else if ($sort_by == 4) $query .= ('ORDER BY presenter_names');
    else if ($sort_by == 5) $query .= ('ORDER BY remaining');
    else $query .= ('ORDER BY f . field_name');

    global $db;

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':ses_id', $ses_id);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
        exit();
    }
}

?>
