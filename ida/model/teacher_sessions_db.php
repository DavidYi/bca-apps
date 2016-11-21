<?php

function get_teachers() {
    $query = 'select u.usr_id, CONCAT(usr_last_name, \', \', usr_first_name) as usr_name, ses_1.pres_id as ses_1_pres_id, ses_2.pres_id as ses_2_pres_id
from user u
left join 
(select x.pres_id, x.usr_id
    from presentation p, pres_user_xref x
    where p.pres_id = x.pres_id
    and p.ses_id = 1) as ses_1 on u.usr_id = ses_1.usr_id

left join 
(select x.pres_id, x.usr_id
    from presentation p, pres_user_xref x
    where p.pres_id = x.pres_id
    and p.ses_id = 2) as ses_2 on u.usr_id = ses_2.usr_id

where usr_type_cde = \'TCH\'
order by usr_name';

    global $db;

    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

function get_pres_list($session_id){
    $query = 'select p.pres_id, rm_nbr, presenter_names, w.wkshp_nme, pres_enrolled_teachers
from presentation p, workshop w, room r
where p.wkshp_id = w.wkshp_id
and p.rm_id = r.rm_id
and p.ses_id = :session_id
order by rm_nbr, wkshp_nme';

    global $db;

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':session_id', $session_id);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }

}

function delete_teacher_from_presentation ($teacher_id, $pres_id) {
    $query = 'delete from pres_user_xref where pres_id=:pres_id and usr_id=:teacher_id';

    global $db;
    $statement = $db->prepare($query);
    $statement->bindValue(":pres_id", $pres_id);
    $statement->bindValue(":teacher_id", $teacher_id);
    $statement->execute();
    $statement->closeCursor();
}

function add_teacher_to_presentation ($teacher_id, $pres_id, $usr_id) {
    $query = 'insert into pres_user_xref (pres_id, usr_id, pres_user_updt_usr_id) 
              values (:pres_id, :teacher_id, :usr_id)';

    global $db;
    $statement = $db->prepare($query);
    $statement->bindValue(":pres_id", $pres_id);
    $statement->bindValue(":teacher_id", $teacher_id);
    $statement->bindValue(":usr_id", $usr_id);
    $statement->execute();
    $statement->closeCursor();
}

function update_teacher_session ($newPresId, $origPresId, $teacherId)
{
    # Perhaps we should include a third case to handle updates, but this works fine.

    global $user;
    if ($origPresId != "") {
        delete_teacher_from_presentation($teacherId, $origPresId);
    }
    if ($newPresId != "") {
        add_teacher_to_presentation($teacherId, $newPresId, $user->usr_id);
    }
}

function update_all_teacher_sessions($teachers, $s1Original, $session1, $s2Original, $session2){

    // begin transaction
    global $db, $user;
    $db->beginTransaction();

    try {
        for($i = 0; $i < count($teachers); $i++) {
            $teacher_id = $teachers[$i];

            if ($session1[$i] != $s1Original[$i])
                update_teacher_session($session1[$i], $s1Original[$i], $teacher_id);

            if ($session2[$i] != $s2Original[$i])
                update_teacher_session($session2[$i], $s2Original[$i], $teacher_id);
        }
        $db->commit();
    } // any errors from the above database queries will be caught here
    catch (PDOException $e) {
        // roll back transaction
        $db->rollback();

        // log any errors to file
        log_pdo_exception ($e, $user->usr_id, "update_all_teacher_sessions");

        display_db_exception($e);
        // display_error("Error saving data.");
        exit();
    }
}



?>