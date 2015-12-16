<?php
/**
 * Created by PhpStorm.
 * User: daviyi
 * Date: 12/16/15
 * Time: 9:04 AM
 */
require_once("../util/main.php");
require_once("model/presentation_db.php");
$action = strtolower(filter_input(INPUT_POST, 'action'));

if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'show_generate_page';
    }
}
switch ($action) {
    case 'show_generate_page':
        $choice = filter_input(INPUT_POST, 'choice');
        $mentors = get_mentors();
        $sessions = get_session_times();
        include("admin/signins/sheetRequest.php");
        break;
    case 'generate':
        $mentor  = filter_input("");
        $pdf = new signinPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


        break;

    case 'mentors': //presenter
        $error_msg = '';
        $mentorList = get_mentor();
        foreach ($mentors as $mentor) {
        }

        break;

    case 'session':
        $error_msg = '';
        $session_id = filter_input(INPUT_POST, 'session_id');
        $studentList = get_student($session);
        $pdf = new signinPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


        break;
}

        ?>