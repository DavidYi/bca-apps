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
    $query = 	'SELECT p.pres_id, p.ses_id, presenter_names, org_name, rm_nbr, format_name, f.format_id, wkshp_nme, wkshp_desc
					pres_max_seat, p.pres_enrolled_seats,  
					pres_max_seat - p.pres_enrolled_seats as remaining
                FROM presentation p, workshop w, format f, room r
                where p.wrkshp_id = w.wrkshp_id
                and w.format_id = f.format_id
                and p.rm_id = r.rm_id
                AND p.pres_enrolled_seats < p.pres_max_seat
				and p.ses_id = :ses_id ';
/*
    if ($sort_by == 1) $query .= ('ORDER BY mentor_field');
    else if ($sort_by == 2) $query .= ('ORDER BY mentor_position');
    else if ($sort_by == 3) $query .= ('ORDER BY mentor_last_name');
    else if ($sort_by == 4) $query .= ('ORDER BY mentor_company');
    else if ($sort_by == 5) $query .= ('ORDER BY remaining');
    else $query .= ('ORDER BY mentor_field');
    if ($order_by == 2) $query.= (' DESC');
*/
    global $db;

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
            and p.wrkshp_id = w.wrkshp_id
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


function get_sessions_by_user($usr_id) {
    $query = 'select session_times.ses_id ses_times, my_ses.ses_id ses_id, rm_nbr, pres_max_seat, pres_enrolled_seats, pres_id, ses_name, ses_start_time, ses_end_time, session_times.sort_order
              from session_times
            
              left join (
              select ses_id, rm_nbr, p.pres_id, presenter_names, org_name, wkshp_nme, wkshp_desc, pres_max_seat, pres_enrolled_seats
              from presentation p, room r, workshop w, pres_user_xref x
              where p.wrkshp_id = w.wrkshp_id
              and p.pres_id = x.pres_id
              and p.rm_id = r.rm_id
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
    public $pres_id, $ses_id, $mentor_id, $pres_enrolled_count, $pres_paired_pres_id, $pres_max_capacity;

    public function __construct ($pres_id, $ses_id, $mentor_id, $pres_enrolled_count, $pres_paired_pres_id, $pres_max_capacity)
    {
        $this->pres_id = $pres_id;
        $this->ses_id = $ses_id;
        $this->mentor_id = $mentor_id;
        $this->pres_enrolled_count = $pres_enrolled_count;
        $this->pres_paired_pres_id = $pres_paired_pres_id;
        $this->pres_max_capacity = $pres_max_capacity;
    }

    public function __toString ()
    {
        return "pres_id:" . $this->pres_id . ";ses_id:" . $this->ses_id .
                ";enrolled:" . $this->pres_enrolled_count . ";max:" . $this->pres_max_capacity;
    }
    public static function getPresentation ($pres_id)
    {
        $query = 'select pres_id, ses_id, presentation.mentor_id, pres_enrolled_count, pres_paired_pres_id, pres_max_capacity
              from presentation
              inner join mentor on mentor.mentor_id = presentation.mentor_id
              where pres_id = :pres_id';

        global $db;

        $statement = $db->prepare($query);
        $statement->bindValue(':pres_id', $pres_id);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();

        $p = new Presentation($result["pres_id"],$result["ses_id"],$result["mentor_id"],$result["pres_enrolled_count"],
                                $result["pres_paired_pres_id"], $result["pres_max_capacity"]);

        return $p;
    }

    public static function getPresentationByUserBySession ($usr_id, $ses_id)
    {
        $query = 'select presentation.pres_id, ses_id, presentation.mentor_id, pres_enrolled_count, pres_paired_pres_id, pres_max_capacity
                  from presentation
                  inner join mentor on presentation.mentor_id = mentor.mentor_id
                  inner join pres_user_xref on presentation.pres_id = pres_user_xref.pres_id
                  where ses_id = :ses_id
                  and usr_id = :usr_id';

        global $db;

        $statement = $db->prepare($query);
        $statement->bindValue(':usr_id', $usr_id);
        $statement->bindValue(':ses_id', $ses_id);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();

        if ($result == false)
            return null;
        else
            return new Presentation($result["pres_id"],$result["ses_id"],$result["mentor_id"],$result["pres_enrolled_count"],
                                    $result["pres_paired_pres_id"], $result["pres_max_capacity"]);
    }

    function has_space()
    {
        if ($this->pres_max_capacity > $this->pres_enrolled_count)
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

        if (isset($_SESSION['prev_usr_id']))
            $statement->bindValue(":pres_user_updt_usr_id", $_SESSION['prev_usr_id']);
        else
            $statement->bindValue(":pres_user_updt_usr_id", $usr_id);

        $statement->execute();
        $statement->closeCursor();
    }

    function delete_presentation_for_user ($usr_id) {
        $query = 'delete from pres_user_xref
                where pres_id = :pres_id
                and usr_id = :usr_id';

        global $db;
        $statement = $db->prepare($query);
        $statement->bindValue(":pres_id", $this->pres_id);
        $statement->bindValue(":usr_id", $usr_id);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function deletePresentationsByUserBySession($usr_id, $ses_id)
    {
        // Load the existing presentation for the user for this session.
        $existingPresentation = Presentation::getPresentationByUserBySession($usr_id, $ses_id);

        // If the user has any existing presentations during the same session time, delete them.
        if ($existingPresentation != null) {
            $existingPresentation->delete_presentation_for_user($usr_id);

            if ($existingPresentation->pres_paired_pres_id != null) {
                $pairedExistingPresentation = Presentation::getPresentation($existingPresentation->pres_paired_pres_id);

                // iterate through a change of presentation ids until we get back to where we started.
                // for each one, delete the associated presentations
                while ($pairedExistingPresentation->pres_id != $existingPresentation->pres_id) {
                    $pairedExistingPresentation->delete_presentation_for_user($usr_id);
                    $pairedExistingPresentation = Presentation::getPresentation($pairedExistingPresentation->pres_paired_pres_id);
                }
            }
        }
    }

    public function addPresForUser ($usr_id)
    {
        // begin transaction
        global $db;
        $db->beginTransaction();

        try {
            Presentation::deletePresentationsByUserBySession($usr_id, $this->ses_id);

            // Inserts the new session for the user.
            $this->insert_presentation_for_user ($usr_id);

            if ($this->pres_paired_pres_id != null) {
                $pairedPresentation = Presentation::getPresentation($this->pres_paired_pres_id);

                // iterate through a change of presentation ids until we get back to where we started.
                while ($pairedPresentation->pres_id != $this->pres_id) {
                    Presentation::deletePresentationsByUserBySession($usr_id, $pairedPresentation->ses_id);

                    // Inserts the new session for the user.
                    $pairedPresentation->insert_presentation_for_user($usr_id);

                    // iterate down the chain of paired presentations.
                    $pairedPresentation = Presentation::getPresentation($pairedPresentation->pres_paired_pres_id);
                }
            }

            // commit transaction
            $db->commit();

        } // any errors from the above database queries will be catched
        catch (PDOException $e) {
            // roll back transaction
            $db->rollback();

            // log any errors to file
            log_pdo_exception ($e, $usr_id, "Adding Presentation:" . $this, "addPresForUser");

            display_error("Error saving data.");
            exit();
        }
    }
}

?>
