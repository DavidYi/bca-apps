<?php

function add_pres($pres_title, $pres_desc, $organization, $location, $usr_id, $field_id, $rm_id, $ses_id, $team_members){
    $query = 'call add_presentation(:pres_title,:pres_desc, :organization, :location, :usr_id, :field_id, :rm_id, :ses_id, :team_members)';
    global $db;

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(":pres_title", $pres_title, PDO::PARAM_STR);
        $statement->bindValue(":pres_desc", $pres_desc, PDO::PARAM_STR);
        $statement->bindValue(":organization", $organization, PDO::PARAM_STR);
        $statement->bindValue(":location", $location, PDO::PARAM_STR);
        $statement->bindValue(":usr_id", $usr_id, PDO::PARAM_INT);
        $statement->bindValue(":field_id", $field_id, PDO::PARAM_INT);
        $statement->bindValue(":rm_id", $rm_id, PDO::PARAM_INT);
        $statement->bindValue(":ses_id", $ses_id, PDO::PARAM_INT);
        $statement->bindValue(":team_members", $team_members, PDO::PARAM_STR);

        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

function mod_pres($pres_id, $pres_title, $pres_desc, $organization, $location, $field_id, $team_members) {
    global $db;
    global $user;
    $query1 = 'UPDATE presentation
              set pres_title = :pres_title,
                  pres_desc = :pres_desc,
                  organization = :organization,
                  location = :location,
                  field_id = :field_id
              WHERE pres_id = :pres_id';

    try {
        $db->beginTransaction();

        $statement = $db->prepare($query1);
        $statement->bindValue(':pres_id', $pres_id, PDO::PARAM_INT);
        $statement->bindValue(':pres_title', $pres_title, PDO::PARAM_STR);
        $statement->bindValue(':pres_desc', $pres_desc, PDO::PARAM_STR);
        $statement->bindValue(':organization', $organization, PDO::PARAM_STR);
        $statement->bindValue(':location', $location, PDO::PARAM_STR);
        $statement->bindValue(':field_id', $field_id, PDO::PARAM_INT);
        $statement->execute();
        $statement->closeCursor();

        $team_members = $team_members . $user->usr_id;
        $query2 = ' delete from user_presentation_xref where usr_id not in (' . $team_members . ') and pres_id = :pres_id and presenting = 1';
        $statement = $db->prepare($query2);
        $statement->bindValue(':pres_id', $pres_id, PDO::PARAM_INT);
        $statement->execute();
        $statement->closeCursor();

        $query3 =
            'insert into user_presentation_xref (usr_id, pres_id, presenting, user_pres_updt_usr_id)
                SELECT u.usr_id, :pres_id1, 1, :usr_id 
                from user u
                left outer join user_presentation_xref x on u.usr_id = x.usr_id and x.presenting = 1 and x.pres_id = :pres_id2
                where u.usr_id in (' . $team_members . ')
                and x.usr_id is nulll';

        $statement = $db->prepare($query3);
        $statement->bindValue(':pres_id1', $pres_id, PDO::PARAM_INT);
        $statement->bindValue(':usr_id', $user->usr_id, PDO::PARAM_INT);
        $statement->bindValue(':pres_id2', $pres_id, PDO::PARAM_INT);
        $statement->execute();
        $statement->closeCursor();

        $db->commit();
    } // any errors from the above database queries will be catched
    catch (PDOException $e) {
        // roll back transaction
        $db->rollback();

        // log any errors to file
        log_pdo_exception ($e, $user->usr_id, "Updating Presentation:" . $pres_id, "mod_pres");

        display_error("Error saving data.");
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
    from (select ses_id, rm_id, ses_name, sort_order, rm_nbr, rm_cap from session_times, room) pairs
    left outer join presentation p on pairs.ses_id = p.ses_id and pairs.rm_id = p.rm_id 
    where (p.ses_id is null and p.rm_id is null)
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

function get_session_room_pairs_plus_presentation($pres_id){
    $query = 'select pairs.rm_id, rm_nbr, pairs.ses_id, rm_cap, ses_name, sort_order
    from (select ses_id, rm_id, ses_name, sort_order, rm_nbr, rm_cap from session_times, room) pairs
    left outer join presentation p on pairs.ses_id = p.ses_id and pairs.rm_id = p.rm_id 
    where (p.ses_id is null and p.rm_id is null) or pres_id = :pres_id
    order by rm_nbr, sort_order';
    global $db;

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':pres_id', $pres_id, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}


function get_potential_teammates(){
    $query = 'select u.usr_last_name, u.usr_first_name, u.usr_id, u.academy_cde
    from user u
    left join user_presentation_xref x on x.usr_id = u.usr_id and x.presenting = 1
    where x.usr_id is null
    and u.usr_grade_lvl = 12
    order by u.usr_last_name, u.usr_first_name';
    global $db;

   return get_list($query);
}

function get_potential_teammates_plus_presentation($pres_id){
    $query = 'select u.usr_last_name, u.usr_first_name, u.usr_id, u.academy_cde
    from user u
    left join user_presentation_xref x on x.usr_id = u.usr_id and x.presenting = 1
    where (x.usr_id is null or pres_id = :pres_id)
    and u.usr_grade_lvl = 12
    order by u.usr_last_name, u.usr_first_name';
    global $db;

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':pres_id', $pres_id, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

function get_presenter_ids($pres_id) {
    $query = "select GROUP_CONCAT( concat ('\'', usr_id, '\'') SEPARATOR ', ') as ids
            from user_presentation_xref
            where pres_id = :pres_id
            and presenting = 1
            group by pres_id";
    
    global $db;
    
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':pres_id', $pres_id, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetch()['ids'];
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }

}


function isSeniortime()
{
    require_once('../model/senior_db.php');
    global $user;
    $signup_dates = get_senior_add_pres_dates();

    date_default_timezone_set('America/New_York');
    $currentTime = time();
    $startTime = strtotime($signup_dates['start']);
    $endTime = strtotime($signup_dates['end']);

    //$startTimeFormatted = date('M d, g:i  a', $startTime);
    //$endTimeFormatted = date('M d, g:i  a', $endTime);


    if (($currentTime > $startTime) and ($currentTime < $endTime))
        return true;
    else
        return false;
}




?>
