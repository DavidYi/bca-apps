<?php
/**
 * Created by PhpStorm.
 * User: daviyi
 * Date: 12/18/2015
 * Time: 1:45 PM
 */
function get_mentors() {
    $query = 	'SELECT mentor.mentor_id,  mentor_last_name ,  mentor_first_name ,  mentor_field ,
					mentor_position , mentor_company ,  mentor_profile ,  mentor_keywords ,
					mentor_email ,  mentor_cell_nbr , mentor_phone_nbr ,  mentor_address ,
					mentor_source ,  mentor_notes ,  active ,  pres_room , pres_host_teacher ,
					pres_max_capacity
					from mentor
					order by mentor.mentor_last_name';

    return get_list($query);
}
//todo: get the list of students from a specific session and mentor
//todo: get the list of all presentations
//todo: get the list of presentations from particular sessio
//todo: get list of presentations of specific mentor
?>