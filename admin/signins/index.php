<?php
/**
 * Created by PhpStorm.
 * User: daviyi
 * Date: 12/16/15
 * Time: 9:04 AM
 */
require_once "../util/main.php";
require_once "../model/database.php";
require_once "model/signins_db.php";
require_once "/admin/signins/signInPDF.php";
require_once '../fpdf/fpdf.php';

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
        $mentors;
        $sessions = get_session_times();
        $session_id = filter_input(INPUT_POST, 'ses_id');
        include("admin/signins/sheetRequest.php");
        break;
    case 'generate':
        $mentor  = filter_input(INPUT_POST, 'mentor');
        $session_id = filter_input(INPUT_POST, 'session');
        $header = array("Id","Name","Signature");
        //todo: get query to find the exact session of the exact mentor if they are both specified
        //todo: get query to find the mentors if mentor = all
        if ($mentors == "all"){
            $title =  "Mentor Sign In";
            $header = array("Name", "Rm #", "Company", "Signature");
            $data = array(
                array()
            );
        }else {
            $title = "Session Sign In";
        }
        $pdf= new FPDF();

        $pdf->SetAuthor('');//todo: add Mentor Name
        $pdf->SetTitle($title);
        $pdf->SetFont('Helvetica','B',20);
        $pdf->AddPage('P');
        $pdf->SetDisplayMode(real,'default');

        $pdf->Image('/image/BCAlogo2.png',10,20,33,0,' ','http://www.fpdf.org/');

        $pdf->SetXY(50,20);
        $pdf->SetDrawColor(50,60,100);
        $pdf->Cell(100,10,$title,1,0,'C',0);

        FancyTable($header, $data);

        $pdf->Output('signin.pdf','I');

//        $pdf = new signinPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
//
//        $pdf->SetCreator(PDF_CREATOR);
//        $pdf->SetAuthor('Nicola Asuni'); //todo: add mentor name
//        $pdf->SetTitle();//todo: add the presentation name
//        $pdf->SetSubject('Sign in');
//        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
//
//        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
        break;
}
?>
