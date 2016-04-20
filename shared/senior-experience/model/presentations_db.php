<?php

function get_field_list() {
    $query = "SELECT field_id, field_name
              FROM field
              ORDER BY field_name";
    return get_list($query);
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
    $query = 	'SELECT presentation.pres_id, pres_title, pres_desc, organization, location, rm_nbr, field_name,
                    pres_max_teachers, pres_max_students, pres_enrolled_teachers, pres_enrolled_students,
					pres_max_students - presentation.pres_enrolled_students as remaining
				FROM mentor
				WHERE presentation.ses_id = :ses_id
				AND mentor.active =1
				AND presentation.pres_enrolled_count < mentor.pres_max_capacity ';

    if ($sort_by == 1) $query .= ('ORDER BY field_name');
    else if ($sort_by == 2) $query .= ('ORDER BY pres_title');
    else if ($sort_by == 3) $query .= ('ORDER BY organization');
    else if ($sort_by == 4) $query .= ('ORDER BY presenter_names');
    else if ($sort_by == 5) $query .= ('ORDER BY remaining');
    else $query .= ('ORDER BY field_name');
    if ($order_by == 2) $query.= (' DESC');
    else $query.= ('ASC');

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
    $query = 'SELECT presentation.pres_id, rm_id, presenter_names,
                organization, location, pres_title, room.rm_nbr, rm_id
              FROM pres_user_xref
              INNER JOIN presentation on presentation.pres_id = pres_user_xref.pres_id
              INNER JOIN presentation on presentation.pres_id = senior_presentation_xref.pres_id
              INNER JOIN room on presentation.rm_id = room.rm_id
              WHERE ses_id = :ses_id
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

/* function get_user_by_username($username) {
    $query = 	'SELECT usr_id, usr_bca_id, usr_type_cde, usr_role_cde, usr_class_year,
                usr_first_name, usr_last_name, usr_active
             FROM user
             WHERE usr_bca_id = :username';

    global $db;

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_error($error_message);
        exit();
    }
}

function get_user($usr_id) {
    $query = 	'SELECT usr_id, usr_bca_id, usr_type_cde, usr_role_cde, usr_class_year,
                    usr_first_name, usr_last_name, usr_active
                 FROM user
                 WHERE usr_id = :usr_id';

    global $db;

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':usr_id', $usr_id);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_error($error_message);
        exit();
    }
}

function get_user_list() {
    $query = 'SELECT usr_id, usr_bca_id, usr_type_cde, usr_class_year,
                 usr_first_name, usr_last_name, usr_active
              from user
              where usr_active = 1
			  order by usr_display_name';

    return get_list($query);
} */

function get_sessions_by_user($usr_id) {
    $query = 'select p.pres_id, pres_title, pres_desc, organization, location, rm_nbr, field_name,
                    get_presenters_comma_list (p.pres_id) presenters,
                    pres_max_teachers, pres_max_students, pres_enrolled_teachers, pres_enrolled_students,
                    t.ses_id, t.ses_start, t.ses_end
            from session_times t
            left join presentation p on t.ses_id = p.ses_id
            and p.pres_id in (select pres_id from user_presentation_xref where usr_id = :usr_id)
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

class Presentation {
    public $pres_id, $ses_id, $rm_id, $rm_nbr, $rm_cap, $field_id, $field_name, $pres_title, $pres_desc, $organization, $location,
            $pres_max_teachers, $pres_max_students, $pres_enrolled_teachers, $pres_enrolled_students;

    public function __construct ($pres_id, $ses_id, $rm_id, $rm_nbr, $rm_cap, $field_id, $field_name, $pres_title, $pres_desc, $organization,
                                 $location, $pres_max_teachers, $pres_max_students, $pres_enrolled_teachers, $pres_enrolled_students)
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
            ";pres_max_teachers:" . $this->pres_max_teachers .
            ";pres_max_students:" . $this->pres_max_students .
            ";pres_enrolled_teachers:" . $this->pres_enrolled_teachers .
            ";pres_enrolled_students:" . $this->pres_enrolled_students;
    }
    public static function getPresentation ($pres_id)
    {
        $query = 'select p.pres_id, p.ses_id, p.rm_id, p.field_id, pres_title, pres_desc, organization, location,
  		        pres_max_teachers, pres_max_students, pres_enrolled_teachers, pres_enrolled_students
                from presentation p
                where p.pres_id = :pres_id';

        global $db;

        $statement = $db->prepare($query);
        $statement->bindValue(':pres_id', $pres_id);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();

        return new Presentation($result["pres_id"],$result["ses_id"],$result["rm_id"],$result["rm_nbr"],$result["rm_cap"],$result["field_id"],
            $result["field_name"],$result["pres_title"], $result["pres_desc"], $result["organization"], $result["location"],
            $result["pres_max_teachers"], $result["pres_max_students"], $result["pres_enrolled_teachers"], $result["pres_enrolled_students"]);
    }

    public static function getPresentationForSenior ($usr_id)
    {
        $query = 'select p.pres_id, p.ses_id, p.rm_id, rm_nbr, rm_cap, p.field_id, f.field_name, pres_title, pres_desc, organization, location,
  		        pres_max_teachers, pres_max_students, pres_enrolled_teachers, pres_enrolled_students
                from presentation p
                left join room r on p.rm_id = r.rm_id
                left join field f on p.field_id = f.field_id
                where p.pres_id in (
					select x.pres_id
                    from senior_presentation_xref x
                    where usr_id = :usr_id)';

        global $db;

        $statement = $db->prepare($query);
        $statement->bindValue(':usr_id', $usr_id);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();

        if ($result == false)
            return null;
        else
            return new Presentation($result["pres_id"],$result["ses_id"],$result["rm_id"],$result["rm_nbr"],$result["rm_cap"],$result["field_id"],
                $result["field_name"],$result["pres_title"], $result["pres_desc"], $result["organization"], $result["location"],
                $result["pres_max_teachers"], $result["pres_max_students"], $result["pres_enrolled_teachers"], $result["pres_enrolled_students"]);
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