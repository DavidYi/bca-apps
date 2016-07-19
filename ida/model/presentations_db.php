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
        display_db_exception($e);
        exit();
    }
}

function get_presentation_list($ses_id, $sort_by, $order_by) {
    global $db;
    global $user;

    $rem = " pres_max_seats - p.pres_enrolled_seats as remaining, ";
    $rem_crit = " AND p.pres_enrolled_seats < p.pres_max_seats ";

    if ($user->usr_type_cde == 'TCH') {
        $rem = " pres_max_teachers - p.pres_enrolled_teachers as remaining, ";
        $rem_crit = " AND p.pres_enrolled_teachers < p.pres_max_teachers ";
    }

    $query = 	"SELECT p.pres_id, p.ses_id, presenter_names, org_name, format_name, f.format_id, wkshp_nme, wkshp_desc,
					pres_max_seats, p.pres_enrolled_seats, "
                . $rem .
                " rm_nbr
                FROM presentation p, workshop w, format f, room r
                where p.wkshp_id = w.wkshp_id
                and w.format_id = f.format_id
                and p.rm_id = r.rm_id
				and p.ses_id = :ses_id "
                . $rem_crit;

    if ($sort_by == 1) $query .= ('ORDER BY wkshp_nme');
    else if ($sort_by == 2) $query .= ('ORDER BY presenter_names');
    else if ($sort_by == 3) $query .= ('ORDER BY format_name');
    else if ($sort_by == 4) $query .= ('ORDER BY remaining');
    else $query .= ('ORDER BY wkshp_nme');
    if ($order_by == 2) $query.= (' DESC');
    else $query.= (' ASC');

    try {
        $statement = $db->prepare($query);  
        $statement->bindValue(':ses_id', $ses_id);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

function get_presentation_by_user($usr_id, $ses_id) {
    $query = 'SELECT p.pres_id, p.ses_id, presenter_names, org_name, rm_nbr, format_name, f.format_id, wkshp_nme, wkshp_desc
            FROM pres_user_xref x, presentation p, workshop w, format f, room r
            where x.pres_id = p.pres_id
            and p.wkshp_id = w.wkshp_id
            and w.format_id = f.format_id
            and p.rm_id = r.rm_id
            and ses_id = :ses_id
            AND usr_id = :usr_id';

    global $db;

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':ses_id', $ses_id);
        $statement->bindValue(':usr_id', $usr_id);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}

function get_presentations_by_user_by_session($usr_id, $ses_id) {
    $query = 'SELECT p.pres_id
              FROM presentation p, pres_user_xref x
              WHERE ses_id = :ses_id
              AND usr_id = :usr_id
              AND p.pres_id = x.pres_id';
    global $db;

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':ses_id', $ses_id);
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


function get_sessions_by_user($usr_id) {
    $query = 'select session_times.ses_id ses_times, my_ses.ses_id ses_id, rm_nbr, pres_max_seats, pres_enrolled_seats, pres_id, ses_name, ses_start_time, ses_end_time, session_times.sort_order, presenter_names, org_name, wkshp_nme, wkshp_desc, format_name
              from session_times
            
              left join (
              select ses_id, rm_nbr, p.pres_id, presenter_names, org_name, wkshp_nme, wkshp_desc, pres_max_seats, pres_enrolled_seats, format_name
              from presentation p, room r, workshop w, pres_user_xref x, format f
              where p.wkshp_id = w.wkshp_id
              and p.pres_id = x.pres_id
              and p.rm_id = r.rm_id
              and w.format_id = f.format_id
              and x.usr_id = :usr_id) my_ses on session_times.ses_id = my_ses.ses_id
              order by session_times.sort_order';

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

class Presentation {
    public $pres_id, $ses_id, $wkshp_id, $presenter_names, $org_name, $rm_id, $rm_nbr, $pres_max_seats, $pres_enrolled_seats, $wkshp_nme, $wkshp_desc, $format_id, $format_name;

    public function __construct ($pres_id, $ses_id, $wkshp_id, $presenter_names, $org_name, $rm_id, $rm_nbr, $pres_max_seats, $pres_enrolled_seats, $wkshp_nme, $wkshp_desc, $format_id, $format_name)
    {
        $this->pres_id = $pres_id;
        $this->ses_id = $ses_id;
        $this->wkshp_id = $wkshp_id;
        $this->presenter_names = $presenter_names;
        $this->org_name = $org_name;
        $this->rm_id = $rm_id;
        $this->rm_nbr = $rm_nbr;
        $this->pres_max_seats = $pres_max_seats;
        $this->pres_enrolled_seats = $pres_enrolled_seats;
        $this->wkshp_nme = $wkshp_nme;
        $this->wkshp_desc = $wkshp_desc;
        $this->format_id = $format_id;
        $this->format_name = $format_name;
    }

    public function __toString ()
    {
        return
            "pres_id:" . $this->pres_id .
            ";ses_id:" . $this->ses_id .
            ";wkshp_id:" . $this->wkshp_id .
            ";presenter_names:" . $this->presenter_names .
            ";org_name:" . $this->org_name .
            ";rm_id:" . $this->rm_id .
            ";rm_nbr:" . $this->rm_nbr .
            ";pres_max_seats:" . $this->pres_max_seats .
            ";pres_enrolled_seats:" . $this->pres_enrolled_seats .
            ";wkshp_nme:" . $this->wkshp_nme .
            ";wkshp_desc:" . $this->wkshp_desc .
            ";format_id:" . $this->format_id .
            ";format_name:" . $this->format_name;
    }

    public static function getPresentation ($pres_id)
    {
        $query = 'select p.pres_id, ses_id, w.wkshp_id, presenter_names, org_name, p.rm_id, rm_nbr, pres_max_seats, pres_enrolled_seats, wkshp_nme, wkshp_desc, f.format_id, f.format_name
              from presentation p, room r, workshop w, format f
              where p.wkshp_id = w.wkshp_id
              and p.rm_id = r.rm_id
              and w.format_id = f.format_id
              and p.pres_id = :pres_id';

        global $db;

        $statement = $db->prepare($query);
        $statement->bindValue(':pres_id', $pres_id);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();

        return new Presentation($result["pres_id"],$result["ses_id"],$result["wkshp_id"],$result["presenter_names"],$result["org_name"],$result["rm_id"],
            $result["rm_nbr"],$result["pres_max_seats"], $result["pres_enrolled_seats"], $result["wkshp_nme"], $result["wkshp_desc"],
            $result["format_id"], $result["format_name"]);
    }

    function has_space()
    {
        global $user;

        if ($this->pres_max_seats > $this->pres_enrolled_seats)
            return true;
        else
            return false;
    }

    function insert_presentation_for_user($usr_id) {
        $query = 'insert into pres_user_xref (pres_id, usr_id, pres_user_updt_usr_id)
              VALUES (:pres_id, :usr_id, :pres_user_updt_usr_id)';

        global $db;
        $statement = $db->prepare($query);
        $statement->bindValue(":pres_id", $this->pres_id);
        $statement->bindValue(":usr_id", $usr_id);
        $statement->bindValue(":pres_user_updt_usr_id", $usr_id);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function deletePresentationsByUser($usr_id, $pres_id)
    {
        $query = 'delete from pres_user_xref
                    where pres_id = :pres_id 
                    and usr_id = :usr_id';

        global $db;
        try {
            $statement = $db->prepare($query);
            $statement->bindValue(":pres_id", $pres_id);
            $statement->bindValue(":usr_id", $usr_id);
            $statement->execute();
            $statement->closeCursor();
        } catch (PDOException $e) {
            display_db_exception($e);
            exit();
        }
    }

    public function addPresForUser ($usr_id)
    {
        // begin transaction
        global $db;
        $db->beginTransaction();

        try {
            // Check if the user currently has a presentation for this session.
            // If so, remove it.
            // The loop is a bit of overkill, but in case of an erroneous situation of the user having multiple
            // presentations for the same session, this will remove those extra cases.
            //
            // Include a check to make sure that presenters don't overwrite their presentations through this method.
            $presentations = get_presentations_by_user_by_session($usr_id, $this->ses_id);
            foreach ($presentations as $presentation) {
                Presentation::deletePresentationsByUser($usr_id, $presentation['pres_id']);
            }

            // Inserts the new session for the user.
            $this->insert_presentation_for_user ($usr_id);

            // commit transaction
            $db->commit();

        } // any errors from the above database queries will be catched
        catch (PDOException $e) {
            // roll back transaction
            $db->rollback();

            // log any errors to file
            log_pdo_exception ($e, $usr_id, "Adding Presentation:" . $this, "addPresForUser");

            display_db_exception($e);
            // display_error("Error saving data.");
            exit();
        }
    }
}

?>
