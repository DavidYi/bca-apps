<?php
require_once('../../util/main.php');
require_once('../../model/database.php');
require_once('../../model/presentations_db.php');

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'list_presentations';
    }
}

switch ($action) {
    case 'list_presentations':

        // Get the presentation list
        $presentationList = get_all_presentations();

        // View the list of presentations
        include 'presentation_list.php';
        exit();
        break;

    case 'show_modify_presentation':
        $presentation_id = filter_input(INPUT_GET, 'presentation_id');
        $presentation = SeniorPresentation::getPresentation($presentation_id);
        $fields = get_field_list();
        //$teachers = get_teachers();
        //$presentation_types = get_presentation_types();
        include '../../senior/show_modify_presentation.php';
        exit();
        break;

    /*case 'modify_presentation':
        $error_msg = '';

        $choice = filter_input(INPUT_POST, 'choice');
        $presentation_id = filter_input(INPUT_POST, 'presentation_id');
        $presentation_nbr = filter_input(INPUT_POST, 'presentation_nbr');
        $presentation_name = filter_input(INPUT_POST, 'presentation_name');
        $presentation_short_name = filter_input(INPUT_POST, 'presentation_short_name');
        $presentation_desc = filter_input(INPUT_POST, 'presentation_desc');
        $teacher_id = filter_input(INPUT_POST, 'teacher');
        $room = filter_input(INPUT_POST, 'room');
        $presentation_type = filter_input(INPUT_POST, 'presentation_type');

        // The user either pressed Add or Cancel.
        // If Add, then add the presentation.
        // Otherwise, just skip down to the list redraw.
        if ($choice == 'Modify') {
            if (empty($presentation_nbr)) {
                $error_msg .= "presentation Number is required.<BR>";
            }
            if (empty($presentation_name)) {
                $error_msg .= "presentation Name is required.<BR>";
            }
            if (empty($teacher_id)) {
                $error_msg .= "Teacher is required.<BR>";
            }
            if (empty($presentation_type)) {
                $error_msg .= "presentation Type is required.<BR>";
            }

            if ($error_msg != "") {
                $teachers = get_teachers();
                $presentation_types = get_presentation_types();
                include 'presentation_modify.php';
                exit();
            }
            else {
                modify_presentation ($presentation_id, $presentation_name, $presentation_short_name, $presentation_desc,
                    $teacher_id, $presentation_nbr, $room, $presentation_type);
            }
        }

        $presentationList = get_presentation_list();
        include('presentation_list.php');
        exit();
        break;


    case 'delete_presentation':
        $presentation_id = filter_input(INPUT_GET, 'presentation_id');
        delete_presentation($presentation_id);

        $presentationList = get_presentation_list();
        include('presentation_list.php');
        exit();
        break;
`   */

    default:
        display_error('Unknown account action: ' . $action);
        exit();
        break;
}
?>