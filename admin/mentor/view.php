<?php

//require_once('../../util/tags.php');
require_once('../../../util/main.php');
require_once('../../../model/database.php');
require_once('../../../model/mentor_admin_db.php');
require_once('../../../model/presentation_db.php');



$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'list_teachers';
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

        $last_name = '';
        $first_name = '';
        $display_name = '';

        include 'teacher_add.php';
        break;

    case 'add_teacher':
        $error_msg = '';

        $choice = filter_input(INPUT_POST, 'choice');
        $last_name = filter_input(INPUT_POST, 'last_name');
        $first_name = filter_input(INPUT_POST, 'first_name');
        $display_name = filter_input(INPUT_POST, 'display_name');

        // The user either pressed Add or Cancel.
        // If Add, then add the teacher.
        // Otherwise, just skip down to the list redraw.
        if ($choice == 'Add') {
            if (empty($last_name)) {
                $error_msg .= "Last name is required.<BR>";
            }
            if (empty($first_name)) {
                $error_msg .= "First name is required.<BR>";
            }
            if (empty($display_name)) {
                $error_msg .= "Display name is required.<BR>";
            }

            if ($error_msg != "") {
                include 'teacher_add.php';
                exit();
            }
            else {
                add_teacher ($last_name, $first_name, $display_name);
            }
        }

        $teacherList = get_teacher_list();
        include('teacher_list.php');
        break;

    case 'show_modify_teacher':

        $teacher_id = filter_input(INPUT_GET, 'teacher_id');

        $teacher = get_teacher($teacher_id);

        $error_msg = '';

        $first_name = $teacher['first_name'];
        $last_name = $teacher['last_name'];
        $display_name = $teacher['display_name'];



        $teachers = get_teacher($teacher_id);

        include 'teacher_modify.php';
        exit();
        break;




    case 'modify_teacher':
        $error_msg = '';
        $choice = filter_input(INPUT_POST, 'choice');

        $first_name = filter_input(INPUT_POST, 'first_name');
        $last_name = filter_input(INPUT_POST, 'last_name');
        $display_name = filter_input(INPUT_POST, 'display_name');

        $teacher_id = filter_input(INPUT_POST, 'teacher_id');

        if ($choice == 'Modify') {
            if (empty($first_name)) {
                $error_msg .= "First Number is required.<BR>";
            }
            if (empty($last_name)) {
                $error_msg .= "Last Name is required.<BR>";
            }
            if (empty($display_name)) {
                $error_msg .= "Display Name is required.<BR>";
            }
            if (empty($teacher_id)) {
                $error_msg .= "Teacher ID is required.<BR>";
            }

            if ($error_msg != "") {
                include 'teacher_modify.php';
                exit();
            }
            else {
                modify_teacher ($teacher_id, $last_name, $first_name, $display_name);
            }
        }

        $teacherList = get_teacher_list();
        include('teacher_list.php');
        exit();
        break;


    case 'delete_teacher':
        $teacher_id = filter_input(INPUT_GET, 'teacher_id');
        delete_teacher($teacher_id);

        $teacherList = get_teacher_list();
        include('teacher_list.php');
        exit();
        break;

    default:
        display_error('Unknown teacher action: ' . $action);
        break;
}
?>