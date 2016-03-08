<?php

function add_pres($pres_title, $pres_desc, $organization, $location, $presenter_names, $senior_list, $usr_id){
    $query = 'call add_presentation(:pres_title,:pres_desc, :organization, :location,
                                    :presenter_names, :usr_id)';

    global $db;

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(":pres_title", $pres_title, PDO::PARAM_STR);
        $statement->bindValue(":pres_desc", $pres_desc, PDO::PARAM_STR);
        $statement->bindValue(":organization", $organization, PDO::PARAM_STR);
        $statement->bindValue(":location", $location, PDO::PARAM_STR);
        $statement->bindValue(":presenter_names", $presenter_names, PDO::PARAM_STR);
        $statement->bindValue(":usr_id", $usr_id, PDO::PARAM_INT);

        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
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
        display_db_exception($e);
        exit();
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
        display_db_exception($e);
        exit();
    }
}




?>
