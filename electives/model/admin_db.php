<?php
/**
 * Created by PhpStorm.
 * User: matth
 * Date: 7/27/2016
 * Time: 10:58 AM
 */

function get_free_mods() {
    global $db;

    $query = "select u.usr_first_name, u.usr_last_name,
              group_concat(times.time_short_desc order by times.sort_order
              SEPARATOR ', ') as mods_available
 
              from user u left join (
  select x.usr_id, t.time_short_desc, t.sort_order
from elect_user_free_xref x, elect_time t
where x.time_id = t.time_id
) as times 
on u.usr_id = times.usr_id

where u.usr_type_cde = \"TCH\"
group by u.usr_id
order by u.usr_last_name";

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