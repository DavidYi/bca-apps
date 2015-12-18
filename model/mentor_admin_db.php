<?php
/**
 * Created by PhpStorm.
 * User: Luklas
 * Date: 12/16/15
 * Time: 9:39 AM
 */

function get_mentor_list() {
    $query = 'SELECT mentor_id, mentor_last_name, mentor_first_name, mentor_field,
                 mentor_position, mentor_company, mentor_profile, mentor_keywords,
                 mentor_email, mentor_cell_nbr, mentor_phone_nbr, mentor_address,
               mentor_source, mentor_notes, active, pres_room, pres_host_teacher,
                  pres_max_capacity
              from mentor

			  order by mentor_last_name';

    return get_list($query);
}

?>