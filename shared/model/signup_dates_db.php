<?php

function get_signup_dates() {
    $query = 'SELECT grade_lvl, mode_desc, signup_dates_mode.mode_cde, start, end
              FROM signup_dates, signup_dates_mode
              WHERE signup_dates.mode_cde = signup_dates_mode.mode_cde and grade_lvl != 13';

    return get_list($query);
}
function get_signup_dates_for_grade($grade) {
    $query = 'SELECT grade_lvl, start, end
              FROM signup_dates
              WHERE grade_lvl = :grade';

    global $db;


    $statement = $db->prepare($query);
    $statement->bindValue(':grade', $grade);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();

    return $result;
}
//
// This method provides no exception handling as the errors are handled in update_signup_dates.
// Do not call this method directly.
//
function update_signup_date_for_grade ($grade_lvl, $mode, $start, $end)
{
    $query = 'update signup_dates       
                set start = :start, end = :end
                WHERE grade_lvl = :grade_lvl
                and mode_cde = :mode_cde';

    global $db;


    $statement = $db->prepare($query);
    $statement->bindValue(':mode_cde', $mode);
    $statement->bindValue(':grade_lvl', $grade_lvl);
    $statement->bindValue(':start', $start);
    $statement->bindValue(':end', $end);
    $statement->execute();
    $statement->closeCursor();
}

function update_signup_dates ($gradeList, $modeList, $startList, $endList)
{
    global $db;
    $db->beginTransaction();
    try {
        for($i = 0; $i < count($gradeList); $i++){
            update_signup_date_for_grade($gradeList[$i], $modeList[$i], $startList[$i], $endList[$i]);
        }
        $db->commit();
    }
    catch (PDOException $e) {
        $db->rollback();
        display_db_exception($e);
        exit();
    }
}


?>