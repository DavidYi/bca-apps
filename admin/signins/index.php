<?php
/**
 * Created by PhpStorm.
 * User: daviyi
 * Date: 12/16/15
 * Time: 9:04 AM
 */
require_once('../../util/main.php');
require_once "model/database.php";
require_once "model/signins_db.php";
require_once "admin/signins/signInPDF.php";

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
        $mentor_id = filter_input(INPUT_POST, 'mentor_id');
        $sessions = get_session_times();
        $session_id = filter_input(INPUT_POST, 'ses_id');
        include("admin/signins/sheetRequest.php");
        break;

    case 'generatet':
        $title = "Mentor Check In";
        $mentorList = get_mentors();
        $mentors = array();
        foreach ($mentorList as $mentorInfo) {
            array_push($mentors, array($mentorInfo['pres_room'], $mentorInfo['pres_host_teacher'],
                $mentorInfo['mentor_last_name'], $mentorInfo['mentor_first_name'], $mentorInfo['mentor_company']));
        }
        $header = array("X", "Name", "Company", "Host Teacher", "Rm #");
        $pdf = new signinPDF();

        $pdf->AddPage("P", "Letter");
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetXY(50, 20);
        $pdf->SetDrawColor(50, 60, 100);
        $pdf->Cell(100, 10, $title, 1, 0, 'C', 0);

        $pdf->FancyTeacher($header, $mentors);

        $pdf->Output('signin.pdf', 'I');
        break;

    case 'generates':
        $mentor_id = filter_input(INPUT_POST, 'mentor');
        $session_id = filter_input(INPUT_POST, 'session');
        $presentations = get_presentation_list($mentor_id, $session_id);
        $header = array("Year", "Academy", "Name", "Signature");
        $pdf = new signinPDF();

        foreach ($presentations as $pres) {
            $title = $pres['ses_name'] . " sign in";
            $students = get_students_in_ses($pres["pres_id"]);
            $pdf->AddPage("P", "Letter");
            $pdf->SetFont('Arial', '', 12);

            $pdf->SetY(20);
            $pdf->Cell(100, 9, "Mentor: " . $pres['mentor_first_name'] . " " . $pres['mentor_last_name']);
            $pdf->Ln();
            $pdf->Cell(100, 9, "Company: " . $pres['mentor_company']);
            $pdf->Ln();
            $pdf->Cell(100, 9, "Host Teacher: " . $pres['pres_host_teacher']);
            $pdf->Ln();
            $pdf->Cell(100, 9, "Room Number: " . $pres['pres_room']);
            $pdf->Ln();
            $pdf->SetX(50);
            $pdf->SetDrawColor(50, 60, 100);
            $pdf->Cell(100, 10, $title, 1, 0, 'C', 0);

            $pdf->FancyStudent($header, $students);
        }


        $pdf->Output('signin.pdf', 'I');
        break;

//    case 'generater':
//        $mentor_id = filter_input(INPUT_POST, 'mentor');
//        $session_id = filter_input(INPUT_POST, 'session');
//        $presentations = get_presentation_list($mentor_id, $session_id);
//        $pdf = new signinPDF();
//
//        foreach ($presentations as $pres) {
//            $pdf->AddPage("L", "Letter");
//            $pdf->SetFont('Arial', '', 60);
//
//            $pdf->Cell($pdf->getW(),$pdf->getH(),pres['mentor_first_name'] . " " . pres['mentor_last_name'], 0, 0, "C");
//        }
//
//        $pdf->Output('roomSigns.pdf', 'I');
//        break;

}
?>
