<?php
/**
 * Created by PhpStorm.
 * User: daviyi
 * Date: 12/16/15
 * Time: 9:04 AM
 */
require_once("../util/main.php");
require_once("../admin/signins/sheetRequest");
$action =  strtolower(filter_input(INPUT_POST, 'action'));

if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'mentors';
    }
}
switch ($action){
    case 'mentors': //presenter
        $error_msg = '';
        $mentorList = get_mentor();
        foreach($mentors as $mentor) {
        }

        $pdf = new signinPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        break;

    case 'session':
        $error_msg = '';
        $session_id = filter_input(INPUT_POST, 'session_id');
        if ($session == null)
            $error_msg = 'Need to know the session to use';
        $studentList = get_student($session);
        $pdf = new signinPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


        break;
}

?>