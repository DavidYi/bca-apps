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
//change
    return get_list($query);
}
function get_presentation_list() {
    $query = 'SELECT p.pres_id, presenter_names, org_name, r.rm_id, r.rm_nbr, pres_max_seats, pres_enrolled_seats, w.wkshp_id, w.wkshp_nme, p.ses_id
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
function get_room_list() {
    $query = 'SELECT rm_nbr, rm_id
              from room
              
			  order by rm_nbr';
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
function add_room($rm_nbr) {
    global $db;
    $query = 'INSERT INTO room
                 (rm_nbr)
              VALUES
                 (:rm_nbr)';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':rm_nbr', $rm_nbr);


        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}
function add_presentation($presenter_names, $org_name, $rm_id, $pres_max_seats, $wkshp_id, $ses_id) {
    global $db;
    $query = 'INSERT INTO presentation
                 (presenter_names, org_name, rm_id, pres_max_seats, wkshp_id, ses_id)
              VALUES
                 (:presenter_names, :org_name, :rm_id, :pres_max_seats, :wkshp_id, :ses_id)';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':presenter_names', $presenter_names);
        $statement->bindValue(':org_name', $org_name);
        $statement->bindValue(':rm_id', $rm_id);
        $statement->bindValue(':pres_max_seats', $pres_max_seats);
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
function modify_presentation($presenter_names, $org_name, $rm_id, $pres_max_seats, $wkshp_id, $ses_id) {
    global $db;
    $query = 'update presentation set
                 presenter_names = :presenter_names, org_name = :org_name,
                 rm_id = :rm_id, pres_max_seats = :pres_max_seats,
                 wkshp_id = :wkshp_id, ses_id = :ses_id
                 where wkshp_id = :wkshp_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':presenter_names', $presenter_names);
        $statement->bindValue(':org_name', $org_name);
        $statement->bindValue(':rm_id', $rm_id);
        $statement->bindValue(':pres_max_seats', $pres_max_seats);
        $statement->bindValue(':wkshp_id', $wkshp_id);
        $statement->bindValue(':ses_id', $ses_id);

        $statement->execute();
        $statement->closeCursor();

    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}
function modify_room($rm_id, $rm_nbr) {
    global $db;
    $query = 'update room set
                 rm_nbr = :rm_nbr
                 where rm_id = :rm_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':rm_id', $rm_id);
        $statement->bindValue(':rm_nbr', $rm_nbr);

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
function get_room($rm_id) {
    global $db;
    $query = 'select * from room where rm_id = :rm_id';

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':rm_id', $rm_id);
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
        $db->beginTransaction();
        delete_users_from_presentations($wkshp_id);
        delete_presentations($wkshp_id);

        $statement = $db->prepare($query);
        $statement->bindValue(':wkshp_id', $wkshp_id);

        $statement->execute();
        $statement->closeCursor();
        $db->commit();
    } catch (PDOException $e) {
        $db->rollBack();
        display_db_exception($e);
        exit();
    }
}
function delete_presentation($pres_id){
    global $db;
    $query = 'delete from presentation
              where pres_id = :pres_id';
    try {
        $db->beginTransaction();
        delete_users_from_presentations_pres($pres_id);

        $statement = $db->prepare($query);
        $statement->bindValue(':pres_id', $pres_id);

        $statement->execute();
        $statement->closeCursor();
        $db->commit();
    } catch (PDOException $e) {
        $db->rollBack();
        display_db_exception($e);
        exit();
    }
}
function delete_room($rm_id){
    global $db;
    $query = 'delete from room
              where rm_id = :rm_id';
    try {
        $db->beginTransaction();
        delete_users_from_presentations_rooms($rm_id);
        delete_rooms_presentations($rm_id);

        $statement = $db->prepare($query);
        $statement->bindValue(':rm_id', $rm_id);

        $statement->execute();
        $statement->closeCursor();
        $db->commit();
    } catch (PDOException $e) {
        $db->rollBack();
        display_db_exception($e);
        exit();
    }
}

function delete_users_from_presentations($wkshp_id){
    global $db;
    $query = 'delete from pres_user_xref
              where pres_id in (select pres_id from presentation where wkshp_id = :wkshp_id)';

    $statement = $db->prepare($query);
    $statement->bindValue(':wkshp_id', $wkshp_id);

    $statement->execute();
    $statement->closeCursor();
}
function delete_users_from_presentations_pres($pres_id){
    global $db;
    $query = 'delete from pres_user_xref
              where pres_id in (select pres_id from presentation where pres_id = :pres_id)';

    $statement = $db->prepare($query);
    $statement->bindValue(':pres_id', $pres_id);

    $statement->execute();
    $statement->closeCursor();
}
function delete_users_from_presentations_rooms($room_id){
    global $db;
    $query = 'delete from pres_user_xref
              where pres_id in (select pres_id from presentation where rm_id = :rm_id)';

    $statement = $db->prepare($query);
    $statement->bindValue(':rm_id', $room_id);

    $statement->execute();
    $statement->closeCursor();
}


function delete_presentations($wkshp_id){
    global $db;
    $query = 'delete from presentation
              where wkshp_id = :wkshp_id';

    $statement = $db->prepare($query);
    $statement->bindValue(':wkshp_id', $wkshp_id);

    $statement->execute();
    $statement->closeCursor();
}
function delete_rooms_presentations($rm_id){
    global $db;
    $query = 'delete from presentation
              where rm_id = :rm_id';

    $statement = $db->prepare($query);
    $statement->bindValue(':rm_id', $rm_id);

    $statement->execute();
    $statement->closeCursor();
}
function get_session_times($ses_id) {
    $query = 'SELECT ses_start_time, ses_end_time
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
        display_db_exception($e);
        exit();
    }
}

//
// This method provides no exception handling as the errors are handled in update_signup_dates.
// Do not call this method directly.
//
function update_session_times_for_session ($ses_id, $start, $end)
{
    $query = 'update session_times      
                set ses_start_time = :ses_start, ses_end_time = :ses_end
                WHERE ses_id = :ses_id';

    global $db;


    $statement = $db->prepare($query);
    $statement->bindValue(':ses_id', $ses_id);
    $statement->bindValue(':ses_start', $start);
    $statement->bindValue(':ses_end', $end);
    $statement->execute();
    $statement->closeCursor();
}

function update_session_times ($start1, $end1, $start2, $end2)
{
    global $db;
    $db->beginTransaction();

    try {
        update_session_times_for_session(1, $start1, $end1);
        update_session_times_for_session(2, $start2, $end2);
        $db->commit();
    }
    catch (PDOException $e) {
        $db->rollback();
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}?>

