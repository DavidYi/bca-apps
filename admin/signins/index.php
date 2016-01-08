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
    case 'generate':
        $mentor = filter_input(INPUT_POST, 'mentor');
        $session_id = filter_input(INPUT_POST, 'session');

        if ($mentor == "All") {
            $title = "Mentor Sign In";
            $mentorList = get_mentors();
            $mentors = array();
            foreach ($mentorList as $mentorInfo){
                array_push ($mentors, array($mentorInfo['pres_room'], $mentorInfo['pres_host_teacher'],
                $mentorInfo['mentor_last_name'], $mentorInfo['mentor_first_name'], $mentorInfo['mentor_company']));
            }
            $header = array("Rm #", "Host Teacher", "Name", "Company", "X");
            $isSession = false;
        } else {
            $title = "Session Sign In";
            $students = get_students_in_ses();
            $header = array("Year", "Name", "Signature");
            $isSession = true;
        }
        $presentations = get_presentation_list();
        $pdf = new signinPDF();
        $pdf->AddPage("P", "A4");

        $pdf->SetFont('Arial', 'B', 12);
//        $pdf->SetY(100);
//        $pdf->Cell(100, 13, "Student Details");
//        $pdf->SetFont('Arial', '');
//        $pdf->Cell(250, 13, $_POST['name']);
//        $pdf->SetFont('Arial', 'B');
//        $pdf->Cell(50, 13, "Date:");
//        $pdf->SetFont('Arial', '');
//        $pdf->Cell(100, 13, date('F j, Y'), 0, 1);
//        $pdf->SetFont('Arial', 'I');
//        $pdf->SetX(140);
//        $pdf->Cell(200, 15, $_POST['e-mail'], 0, 2);
//        $pdf->Cell(200, 15, $_POST['Address'] . ',' . $_POST['City'], 0, 2);
//        $pdf->Cell(200, 15, $_POST['Country'], 0, 2);
//
//        $pdf->SetTitle($title);
//        $pdf->SetFont('Helvetica', 'B', 20);
//        $pdf->AddPage('P');
//        $pdf->SetDisplayMode(real, 'default');
//
//        $pdf->Image('/image/BCAlogo2.png', 10, 20, 33, 33);
//
//        $pdf->SetXY(50, 20);
//        $pdf->SetDrawColor(50, 60, 100);
        $pdf->Cell(100, 10, $title, 1, 0, 'C', 0);

        if ($mentor == 'All')
            $pdf->Fancy($header, $mentors, $isSession);
        else
            $pdf->Fancy($header, $students, $isSession);

        $pdf->Output('signin.pdf', 'I');
        break;
}
?>
