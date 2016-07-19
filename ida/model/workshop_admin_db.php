<?php
/**
 * Created by PhpStorm.
 * User: Luklas
 * Date: 12/16/15
 * Time: 9:39 AM
 */

function get_workshop_list() {
    $query = 'SELECT wkshp_id, wkshp_nme, wkshp_desc, format_id
              from workshop

			  order by wkshp_id';

    return get_list($query);
}

function get_presentation_list() {
    $query = 'SELECT presenter_names, org_name, r.rm_id, r.rm_nbr, pres_max_seats, pres_enrolled_seats, w.wkshp_id, w.wkshp_nme, p.ses_id
              from  workshop w, session_times s, presentation p
                left join room r
                on p.rm_id = r.rm_id

				where p.wkshp_id = w.wkshp_id
                and p.ses_id = s.ses_id
			  order by pres_id';

    return get_list($query);
}

function get_format_list() {
    $query = 'SELECT format_id, format_name
              from format
              
			  order by format_id';

    return get_list($query);
}


function add_workshop($wkshp_nme, $wkshp_desc, $format_id) {
    global $db;
    $query = 'INSERT INTO workshop
                 (wkshp_nme, wkshp_desc, format_id)
              VALUES
                 (:wkshp_nme, :wkshp_desc, :format_id)';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':wkshp_nme', $wkshp_nme);
        $statement->bindValue(':wkshp_desc', $wkshp_desc);
        $statement->bindValue(':format_id', $format_id);


        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

function add_presentation($presenter_names, $org_name, $rm_id, $pres_max_seats, $pres_enrolled_seats, $wkshp_id, $ses_id) {
    global $db;
    $query = 'INSERT INTO presentation
                 (presenter_names, org_name, rm_id, pres_max_seats, pres_enrolled_seats, wkshp_id, ses_id)
              VALUES
                 (:presenter_names, :org_name, :rm_id, :pres_max_seats, :pres_enrolled_seats, :wkshp_id, :ses_id)';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':presenter_names', $presenter_names);
        $statement->bindValue(':org_name', $org_name);
        $statement->bindValue(':rm_id', $rm_id);
        $statement->bindValue(':pres_max_seats', $pres_max_seats);
        $statement->bindValue(':pres_enrolled_seats', $pres_enrolled_seats);
        $statement->bindValue(':wkshp_id', $wkshp_id);
        $statement->bindValue(':ses_id', $ses_id);


        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

function modify_workshop($wkshp_nme, $wkshp_desc, $format_id, $workshop_id) {
    global $db;
    $query = 'update workshop set
                 wkshp_nme = :wkshp_nme, wkshp_desc = :wkshp_desc,
                 format_id = :format_id
                 where wkshp_id = :wkshp_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':wkshp_nme', $wkshp_nme);
        $statement->bindValue(':wkshp_desc', $wkshp_desc);
        $statement->bindValue(':format_id', $format_id);
        $statement->bindValue(':wkshp_id', $workshop_id);

        $statement->execute();
        $statement->closeCursor();

    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

function get_workshop($wkshp_id) {
    global $db;
    $query = 'select * from workshop where wkshp_id = :wkshp_id';

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':wkshp_id', $wkshp_id);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

function get_presentation($pres_id) {
    global $db;
    $query = 'select * from presentation where pres_id = :pres_id';

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':pres_id', $pres_id);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

function get_format($format_id) {
    global $db;
    $query = 'select * from format where format_id = :format_id';

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':format_id', $format_id);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

function delete_workshop($wkshp_id){
    global $db;
    $query = 'delete from workshop
              where wkshp_id = :wkshp_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':wkshp_id', $wkshp_id);

        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

function delete_presentations($wkshp_id){
    global $db;
    $query = 'delete from presentation
              where wkshp_id = :wkshp_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':wkshp_id', $wkshp_id);

        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}
?>

