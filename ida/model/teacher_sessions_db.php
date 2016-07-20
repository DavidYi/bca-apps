<?php

function get_teachers() {
    $query = 'select u.usr_id, CONCAT(usr_last_name, \', \', usr_first_name) as usr_name, ses_1.pres_id, ses_2.pres_id
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
order by wkshp_nme, rm_nbr';

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



?>