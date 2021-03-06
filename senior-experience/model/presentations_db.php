<?php

function get_field_list() {
    $query = "SELECT field_id, field_name
              FROM field
              ORDER BY field_name";
    return get_list($query);
}

function get_session_room_pairs() {
    $query = "select a.rm_id, a.ses_id,rm_nbr
              from (select rm_id, ses_id, rm_nbr, ses_name, sort_order from room r, session_times t) as a
              left outer join presentation p on a.rm_id = p.rm_id and a.ses_id = p.ses_id
              where p.rm_id is null and p.ses_id is null
              order by sort_order, rm_nbr";
    return get_list($query);
}

# Used for exporting to CSV on itinerary page.
function all_presentations_download() {
    $query =
        'select p.ses_id, rm_nbr, field_name, pres_title, organization, location, 
                p.pres_desc, get_presenters_comma_list(p.pres_id),
                pres_max_students - pres_enrolled_students
        from presentation p, room r, field f
        where p.rm_id = r.rm_id
        and p.field_id = f.field_id
        order by ses_id, field_name ';

    global $db;

    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}


function get_all_presentations(){
    $query = "select p.pres_id, p.pres_title, rm_nbr, ses_id, concat (pres_enrolled_teachers, '/',pres_max_teachers) as teachers,
                concat (pres_enrolled_students, '/',pres_max_students) as students,
                GROUP_CONCAT( concat (usr_first_name, ' ', usr_last_name) order by usr_last_name SEPARATOR ', ')
                from user_presentation_xref x, user u, presentation p
                left join room r on p.rm_id = r.rm_id
                where p.pres_id = x.pres_id
                and x.usr_id = u.usr_id
                and x.presenting = 1
                group by p.pres_id
                order by rm_nbr";

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

    $rem = " pres_max_students - presentation.pres_enrolled_students as remaining, ";
    $rem_crit = " AND presentation.pres_enrolled_students < presentation.pres_max_students ";

    if ($user->usr_type_cde == 'TCH') {
        $rem = " pres_max_teachers - presentation.pres_enrolled_teachers as remaining, ";
        $rem_crit = " AND presentation.pres_enrolled_teachers < presentation.pres_max_teachers ";
    }

    $query = 	"SELECT presentation.pres_id, pres_title, pres_desc, organization, location, presentation.rm_id, field_name,
                    pres_max_teachers, pres_max_students, pres_enrolled_teachers, pres_enrolled_students, "
                    . $rem .
					" get_presenters_comma_list (presentation.pres_id) presenter_names,
					get_full_name_presenters_comma_list (presentation.pres_id) full_presenters, 
					rm_nbr
				FROM presentation, field, room
				WHERE presentation.ses_id = :ses_id
				AND presentation.field_id = field.field_id
				and presentation.rm_id = room.rm_id "
                . $rem_crit;

    if ($sort_by == 1) $query .= ('ORDER BY field_name');
    else if ($sort_by == 2) $query .= ('ORDER BY organization');
    else if ($sort_by == 3) $query .= ('ORDER BY presenter_names');
    else if ($sort_by == 4) $query .= ('ORDER BY rm_nbr');
    else if ($sort_by == 5) $query .= ('ORDER BY remaining');
    else $query .= ('ORDER BY field_name');
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
    $query = 'SELECT presentation.pres_id, presentation.rm_id,
                organization, location, pres_title, room.rm_nbr, room.rm_id, 
                get_presenters_comma_list (presentation.pres_id) presenters,
                get_full_name_presenters_comma_list (presentation.pres_id) full_presenters
                
              FROM presentation, room, user_presentation_xref
              WHERE ses_id = :ses_id
              AND usr_id = :usr_id
              AND presentation.pres_id = user_presentation_xref.pres_id
              AND presentation.rm_id = room.rm_id';

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
    $query = 'SELECT p.pres_id, presenting
              FROM presentation p, user_presentation_xref x
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
    $query = 'select p.pres_id, pres_title, pres_desc, organization, location, rm_nbr, field_name,
                    get_presenters_comma_list (p.pres_id) presenter_names,
                    get_full_name_presenters_comma_list (p.pres_id) full_presenters, 
                    pres_max_teachers, pres_max_students, pres_enrolled_teachers, pres_enrolled_students,
                    t.ses_id, t.ses_start, t.ses_end, presenting
                from session_times t
                left join presentation p on t.ses_id = p.ses_id and p.pres_id in (
                    select pres_id from user_presentation_xref where usr_id = :usr_id
                )
                left join user_presentation_xref x on p.pres_id = x.pres_id and x.usr_id = :usr_id            
                left join room r on p.rm_id = r.rm_id
                left join field f on p.field_id = f.field_id
                order by t.sort_order';

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
    }
}

class SeniorPresentation {
    public $pres_id, $ses_id, $rm_id, $rm_nbr, $rm_cap, $field_id, $field_name, $pres_title, $pres_desc, $organization, $location,
            $pres_max_teachers, $pres_max_students, $pres_enrolled_teachers, $pres_enrolled_students, $presenters;

    public function __construct ($pres_id, $ses_id, $rm_id, $rm_nbr, $rm_cap, $field_id, $field_name, $pres_title, $pres_desc, $organization,
                                 $location, $pres_max_teachers, $pres_max_students, $pres_enrolled_teachers, $pres_enrolled_students, $presenters)
    {
        $this->pres_id = $pres_id;
        $this->ses_id = $ses_id;
        $this->rm_id = $rm_id;
        $this->rm_nbr = $rm_nbr;
        $this->rm_cap = $rm_cap;
        $this->field_id = $field_id;
        $this->field_name = $field_name;
        $this->pres_title = $pres_title;
        $this->pres_desc = $pres_desc;
        $this->organization = $organization;
        $this->location = $location;
        $this->pres_max_teachers = $pres_max_teachers;
        $this->pres_max_students = $pres_max_students;
        $this->pres_enrolled_teachers = $pres_enrolled_teachers;
        $this->pres_enrolled_students = $pres_enrolled_students;
        $this->presenters = $presenters;
    }

    public function __toString ()
    {
        return
            "pres_id:" . $this->pres_id .
            ";ses_id:" . $this->ses_id .
            ";rm_id:" . $this->rm_id .
            ";field_id:" . $this->field_id .
            ";pres_title:" . $this->pres_title .
            ";pres_desc:" . $this->pres_desc .
            ";organization:" . $this->organization .
            ";location:" . $this->location .
            ";presenters:" . $this->presenters .
            ";pres_max_teachers:" . $this->pres_max_teachers .
            ";pres_max_students:" . $this->pres_max_students .
            ";pres_enrolled_teachers:" . $this->pres_enrolled_teachers .
            ";pres_enrolled_students:" . $this->pres_enrolled_students;
    }
    public static function getPresentation ($pres_id)
    {
        $query = 'select p.pres_id, p.ses_id, p.rm_id, p.field_id, field_name, pres_title, pres_desc, organization, location,
  		        pres_max_teachers, pres_max_students, pres_enrolled_teachers, pres_enrolled_students, get_presenters_comma_list (p.pres_id) presenters, r.rm_nbr
                from presentation p, room r, field f
                where p.rm_id = r.rm_id
                and p.field_id = f.field_id
                and p.pres_id = :pres_id';

        global $db;

        $statement = $db->prepare($query);
        $statement->bindValue(':pres_id', $pres_id);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();

        return new SeniorPresentation($result["pres_id"],$result["ses_id"],$result["rm_id"],$result["rm_nbr"],$result["pres_max_students"],$result["field_id"],
            $result["field_name"],$result["pres_title"], $result["pres_desc"], $result["organization"], $result["location"],
            $result["pres_max_teachers"], $result["pres_max_students"], $result["pres_enrolled_teachers"],
            $result["pres_enrolled_students"], $result["presenters"]);
    }

    public static function getPresentationForSenior ($usr_id)
    {
        $query = 'select p.pres_id, p.ses_id, p.rm_id, rm_nbr, rm_cap, p.field_id, f.field_name, pres_title, pres_desc, organization, location,
  		        pres_max_teachers, pres_max_students, pres_enrolled_teachers, pres_enrolled_students, get_presenters_comma_list (p.pres_id) presenters
                from presentation p
                left join room r on p.rm_id = r.rm_id
                left join field f on p.field_id = f.field_id
                where p.pres_id in (
					select x.pres_id
                    from user_presentation_xref x
                    where usr_id = :usr_id
                    and presenting = 1)';

        global $db;

        $statement = $db->prepare($query);
        $statement->bindValue(':usr_id', $usr_id);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();

        if ($result == false)
            return null;
        else
            return new SeniorPresentation($result["pres_id"],$result["ses_id"],$result["rm_id"],$result["rm_nbr"],$result["rm_cap"],$result["field_id"],
                $result["field_name"],$result["pres_title"], $result["pres_desc"], $result["organization"], $result["location"],
                $result["pres_max_teachers"], $result["pres_max_students"], $result["pres_enrolled_teachers"],
                $result["pres_enrolled_students"], $result["presenters"]);
    }

    function has_space()
    {
        global $user;

        if ((($user->usr_type_cde == 'TCH') && ($this->pres_max_teachers > $this->pres_enrolled_teachers)) ||
            (($user->usr_type_cde == 'STD') && ($this->pres_max_students > $this->pres_enrolled_students)))
            return true;
        else
            return false;
    }

    function insert_presentation_for_user($usr_id) {
        $query = 'insert into user_presentation_xref (pres_id, usr_id, presenting, user_pres_updt_usr_id)
              VALUES (:pres_id, :usr_id, 0, :pres_user_updt_usr_id)';

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
        $query = 'delete from user_presentation_xref
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
                if ($presentation['presenting'] == 1) {
                    $db->rollback();
                    display_user_message("You cannot add a presentation for this session since you are presenting at the same time.", '../itinerary');
                    exit();
                }
                SeniorPresentation::deletePresentationsByUser($usr_id, $presentation['pres_id']);
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

            display_error("Error saving data.");
            exit();
        }
    }


}

?>
