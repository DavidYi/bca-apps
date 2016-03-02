<?php

function add_pres($pres_title, $pres_desc, $organization, $location, $presenter_names){
    $query = 'insert into presentation (pres_title, pres_desc, organization, location, presenter_names)
              VALUES (:pres_title, :pres_desc, :organization, :location, :presenter_names)';

    global $db;
    $statement = $db->prepare($query);
    $statement->bindValue(":pres_title", $pres_title);
    $statement->bindValue(":pres_desc", $pres_desc);
    $statement->bindValue(":organization", $organization);
    $statement->bindValue(":location", $location);
    $statement->bindValue(":presenter_names", $presenter_names);

    $statement->execute();
    $statement->closeCursor();
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
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function get_senior_add_pres_dates() {
    $query = 'SELECT * from signup_dates
              WHERE grade_lvl = 12 and mode_cde = \'PRE\' ';

    global $db;

    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}



function get_session_room_num_pairs(){
    $query = 'select pairs.rm_id, rm_nbr, pairs.ses_id, rm_cap, ses_name, sort_order
    from presentation p
    right outer join (select ses_id, rm_id, ses_name, sort_order, rm_nbr, rm_cap from session_times, room) pairs
    on p.ses_id = pairs.ses_id
    and p.rm_id = pairs.rm_id
    and p.ses_id is null
    and p.rm_id is null
    order by rm_nbr, sort_order';
    global $db;

    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}




?>
