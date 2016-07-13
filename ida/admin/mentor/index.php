<?php

require_once('../../util/main.php');
require_once('../../model/workshop_admin_db.php');

verify_admin();

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'list_mentors';
    }
}

switch ($action) {
    case 'list_mentors':

        // Get the teacher list
        $mentorList = get_mentor_list();

        // View the list of teachers
        include 'mentor_list.php';
        break;

    case 'show_add_mentor':
        $error_msg = '';
        //active not included here right?
        $mentorId = '';
        $mentor_first_name = '';
        $mentor_last_name = '';
        $mentor_position = '';
        $mentor_company = '';
        $pres_room = '';
        $pres_host_teacher = '';
        $pres_max_teacher = '';
        $mentor_profile = '';
        $mentor_notes = '';
        $mentor_field = '';
        $active = 0;
        $pres_max_capacity ='';
        $mentor_keywords = '';

        include 'mentor_add.php';
        break;

    case 'add_mentor':
        $choice = filter_input(INPUT_POST, 'choice');
        $mentorId = filter_input(INPUT_POST, 'mentorId');
        $mentor_first_name = filter_input(INPUT_POST, 'mentor_first_name');
        $mentor_last_name = filter_input(INPUT_POST, 'mentor_last_name');
        $mentor_position = filter_input(INPUT_POST, 'mentor_position');
        $mentor_company = filter_input(INPUT_POST, 'mentor_company');
        $pres_room = filter_input(INPUT_POST, 'pres_room');
        $pres_host_teacher = filter_input(INPUT_POST, 'pres_host_teacher');
        $pres_max_teacher = filter_input(INPUT_POST, 'pres_max_teacher');
        $pres_max_capacity = filter_input(INPUT_POST, 'pres_max_capacity');
        $mentor_profile = filter_input(INPUT_POST, 'mentor_profile');
        $mentor_field = filter_input(INPUT_POST, 'mentor_field');
        $mentor_address = filter_input(INPUT_POST, 'mentor_adress');
        $mentor_keywords = filter_input(INPUT_POST, 'mentor_keywords');
        $mentor_source = filter_input(INPUT_POST, 'mentor_source');


        // The user either pressed Add or Cancel.
        // If Add, then add the mentor.
        // Otherwise, just skip down to the list redraw.

        if ($choice == 'Add') {
            add_mentor($mentor_last_name, $mentor_first_name, $mentor_field, $mentor_position, $mentor_company, $mentor_profile, $mentor_keywords
                , null, null, null, null, null, null, $pres_room,
                $pres_host_teacher, $pres_max_capacity);
        }
        $mentorList = get_mentor_list();
        include('mentor_list.php');
        break;

    case 'show_modify_mentor':

        $mentor_id = filter_input(INPUT_GET, 'mentor_id');

        $mentor = get_mentor($mentor_id);


        $mentor_first_name = $mentor['mentor_first_name'];
        $mentor_last_name = $mentor['mentor_last_name'];
        $mentor_suffix = $mentor['mentor_suffix'];
        $mentor_field = $mentor['mentor_field'];
        $mentor_position = $mentor['mentor_position'];
        $mentor_company = $mentor['mentor_company'];
        $mentor_profile = $mentor['mentor_profile'];
        $mentor_keywords = $mentor['mentor_keywords'];
        $pres_room = $mentor['pres_room'];
        $pres_host_teacher = $mentor['pres_host_teacher'];
        $pres_max_capacity = $mentor['pres_max_capacity'];

        include 'mentor_modify.php';
        exit();
        break;




    case 'modify_mentor':
        $choice = filter_input(INPUT_POST, 'choice');
        $mentorId = filter_input(INPUT_POST, 'mentor_id');
        $mentor_first_name = filter_input(INPUT_POST, 'mentor_first_name');
        $mentor_last_name = filter_input(INPUT_POST, 'mentor_last_name');
        $mentor_suffix = filter_input(INPUT_POST, 'mentor_suffix');
        $mentor_position = filter_input(INPUT_POST, 'mentor_position');
        $mentor_company = filter_input(INPUT_POST, 'mentor_company');
        $pres_room = filter_input(INPUT_POST, 'pres_room');
        $pres_host_teacher = filter_input(INPUT_POST, 'pres_host_teacher');
        $pres_max_teacher = filter_input(INPUT_POST, 'pres_max_teacher');
        $pres_max_capacity = filter_input(INPUT_POST, 'pres_max_capacity');
        $mentor_profile = filter_input(INPUT_POST, 'mentor_profile');
        $mentor_field = filter_input(INPUT_POST, 'mentor_field');
        $mentor_keywords = filter_input(INPUT_POST, 'mentor_keywords');

        if(filter_input(INPUT_POST, 'choice') == "Modify") {

            modify_mentor($mentorId, $mentor_last_name, $mentor_first_name, $mentor_suffix, $mentor_field, $mentor_position, $mentor_company, $mentor_profile, $mentor_keywords
                ,  $pres_room,
                $pres_host_teacher, $pres_max_capacity);
        }


        $mentorList = get_mentor_list();
        include('mentor_list.php');
        exit();
        break;


    case 'delete_teacher':
        $mentor_id = filter_input(INPUT_GET, 'teacher_id');
        delete_mentor($mentor_id);

        $mentorList = get_mentor_list();
        include('mentor_list.php');
        exit();
        break;

    default:
        display_error('Unknown mentor action: ' . $action);
        break;
}
?>