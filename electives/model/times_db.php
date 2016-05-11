<?php
/**
 * Created by PhpStorm.
 * User: joshClune
 * Date: 5/11/16
 * Time: 9:29 AM
 */
function get_times_list(){
    $query = 'SELECT usr_id, time_id
              from elect_user_free_xref';

    return get_list($query);
}


?>