<?php

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

//
// This method provides no exception handling as the errors are handled in update_signup_dates.
// Do not call this method directly.
//
function update_signup_date_for_grade ($grade_lvl, $start, $end)
{
    $query = 'update signup_dates       
                set start = :start, end = :end
                WHERE grade_lvl = :grade_lvl';

    global $db;


    $statement = $db->prepare($query);
    $statement->bindValue(':grade_lvl', $grade_lvl);
    $statement->bindValue(':start', $start);
    $statement->bindValue(':end', $end);
    $statement->execute();
    $statement->closeCursor();
}

function update_signup_dates ($start9, $end9, $start10, $end10, $start11, $end11, $start12, $end12)
{
    global $db;
    $db->beginTransaction();

    try {
        update_signup_date_for_grade(9, $start9, $end9);
        update_signup_date_for_grade(10, $start10, $end10);
        update_signup_date_for_grade(11, $start11, $end11);
        update_signup_date_for_grade(12, $start12, $end12);
        $db->commit();
    }
    catch (PDOException $e) {
        $db->rollback();
    } catch (PDOException $e) {
        display_db_exception($e);
        exit();
    }
}


?>