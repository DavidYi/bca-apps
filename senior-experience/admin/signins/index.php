<?php
/**
 * Created by PhpStorm.
 * User: daviyi
 * Date: 12/16/15
 * Time: 9:04 AM
 */
require_once('../../util/main.php');
require_once ("../../model/database.php");
require_once "../../model/signins_db.php";
require_once "signInPDF.php";

verify_admin();
 
$action = strtolower(filter_input(INPUT_POST, 'action'));

if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'show_generate_page';
    }
}

switch ($action) {
    case 'show_generate_page':
        include("sheetRequest.php");
        break;

    case 'generates':
        $choice = filter_input(INPUT_POST, 'choice');
        $presentations = get_presentation_list();
        $header = array("Name", "Grade", "Academy", "Signature");
        $pdf = new signinPDF();

        foreach ($presentations as $pres) {
            $title = $pres['ses_name'] . " sign in";
            $teachers = get_teachers_in_ses($pres["pres_id"]);
            $presenters = get_presenters_in_ses($pres["pres_id"]);
            $students = get_students_in_ses($pres["pres_id"]);
            
            $pdf->AddPage("P", "Letter");
            $pdf->SetFont('Arial', '', 12);

            $pdf->SetY(10);
            $pdf->Cell(100, 9, "Title: " . $pres['pres_title']);
            $pdf->Ln();
            $pdf->Cell(100, 9, "Room: " . $pres['rm_nbr']);
            $pdf->Ln();
            $pdf->Cell(100, 9, "Session: " . $pres['ses_id'] . " (" . $pres['ses_start'] . " - " . $pres['ses_end'] . ")");
            $pdf->Ln();
            $pdf->Cell(100, 9, "Presenters: " . $presenters);
            $pdf->Ln();
            $pdf->Cell(100, 9, "Teachers: " . $teachers);
            $pdf->Ln();
//            $pdf->SetX(50);
//            $pdf->SetDrawColor(50, 60, 100);
//            $pdf->Cell(100, 10, $title, 1, 0, 'C', 0);

            $pdf->FancyStudent($header, $students);
        }

        $pdf->Output('signin.pdf', 'I');
        break;

    case 'generater':
        $rooms = get_rooms();
        $pdf = new signinPDF();
        $pdf->SetAutoPageBreak(false);

        foreach ($rooms as $room) {
            $ses_1 = get_session_by_room($room['rm_id'], 1);
            $ses_2 = get_session_by_room($room['rm_id'], 2);
            $ses_3 = get_session_by_room($room['rm_id'], 3);
            $ses_4 = get_session_by_room($room['rm_id'], 4);

            $pdf->AddPage("L", "Letter");
            $pdf->SetFont('Arial', '', 50);

            $WMargin = $pdf->getlMargin() + $pdf->getrMargin();
            $HMargin = $pdf->gettMargin() + $pdf->gettMargin();

            //have double border
            $pdf->SetDrawColor(0, 0, 0);
            $pdf->SetLineWidth(1.25);
            $pdf->Rect($pdf->getrMargin(), $pdf->gettMargin(),
                $pdf->getW() - $WMargin, $pdf->getH() - $HMargin);
            $pdf->Rect($pdf->getrMargin() + 2, $pdf->gettMargin() + 2,
                $pdf->getW() - $WMargin - 4, $pdf->getH() - $HMargin - 4);

            $pdf->setY ($pdf->getY() + 5);

            $pdf->SetFont('Arial', 'B', 40);
            $pdf->Cell(0, 25, "Senior Exhibitions", 0, 1, "C");

//            $pdf->SetFont('Arial', 'B', 30);
//            $pdf->Cell(0, $pdf->getH() / 15, "June 1, 2016", 0, 1, "C");

            $pdf->setY ($pdf->getY() + 5);

            $pdf->SetFont('Arial', 'B', 30);
            $pdf->Cell(0, 0, "Room " . $room['rm_nbr'], 0, 1, "C");

            $pdf->setY ($pdf->getY() + 10);

/*            $pdf->SetLineWidth(1.25);
            $pdf->Line($pdf->getlMargin()+ 40, $pdf->getY(),
                $pdf->getW() - $pdf->getrMargin() - 40, $pdf->getY());
*/
            $lineSpacing = 9;
            $leftSessionIndent = 20;
            $hangingIndent = 8;

            $pdf->setY ($pdf->getY() + 7);

            $pdf->SetFont('Arial', '', 20);
            $pdf->Cell($leftSessionIndent, 25, "", 0, 0, "L");
            $pdf->Cell(20, $lineSpacing, "9:00", 0, 0, "R");
            $pdf->Cell($hangingIndent, $lineSpacing, "", 0, 0, "R");
            $pdf->Cell(0, $lineSpacing, '' . $ses_1['pres_title'], 0, 2, "L");
            $pdf->SetFont('Arial', '', 15);

            $org = '@ ' . $ses_1['organization'];
            $pres = 'by ' . $ses_1['full_presenters'];
            if (empty($ses_1['organization'])) {
                $org = '';
                $pres = '';
            }
            $pdf->Cell(0, $lineSpacing, $org, 0, 2, "L");
            $pdf->Cell(0, $lineSpacing, $pres, 0, 1, "L");

            $pdf->setY ($pdf->getY() + 8);
            $pdf->SetFont('Arial', '', 20);
            $pdf->Cell($leftSessionIndent, 25, "", 0, 0, "L");
            $pdf->Cell(20, $lineSpacing, "9:30", 0, 0, "R");
            $pdf->Cell($hangingIndent, $lineSpacing, "", 0, 0, "R");
            $pdf->Cell(0, $lineSpacing, '' . $ses_2['pres_title'], 0, 2, "L");
            $pdf->SetFont('Arial', '', 15);
            $org = '@ ' . $ses_2['organization'];
            $pres = 'by ' . $ses_2['full_presenters'];
            if (empty($ses_2['organization'])) {
                $org = '';
                $pres = '';
            }
            $pdf->Cell(0, $lineSpacing, $org, 0, 2, "L");
            $pdf->Cell(0, $lineSpacing, $pres, 0, 1, "L");

            $pdf->setY ($pdf->getY() + 8);
            $pdf->SetFont('Arial', '', 20);
            $pdf->Cell($leftSessionIndent, 25, "", 0, 0, "L");
            $pdf->Cell(20, $lineSpacing, "10:00", 0, 0, "R");
            $pdf->Cell($hangingIndent, $lineSpacing, "", 0, 0, "R");
            $pdf->Cell(0, $lineSpacing, '' . $ses_3['pres_title'], 0, 2, "L");
            $pdf->SetFont('Arial', '', 15);
            $org = '@ ' . $ses_3['organization'];
            $pres = 'by ' . $ses_3['full_presenters'];
            if (empty($ses_3['organization'])) {
                $org = '';
                $pres = '';
            }
            $pdf->Cell(0, $lineSpacing, $org, 0, 2, "L");
            $pdf->Cell(0, $lineSpacing, $pres, 0, 1, "L");

            $pdf->setY ($pdf->getY() + 8);
            $pdf->SetFont('Arial', '', 20);
            $pdf->Cell($leftSessionIndent, 25, "", 0, 0, "L");
            $pdf->Cell(20, $lineSpacing, "10:30", 0, 0, "R");
            $pdf->Cell($hangingIndent, $lineSpacing, "", 0, 0, "R");
            $pdf->Cell(0, $lineSpacing, '' . $ses_4['pres_title'], 0, 2, "L");
            $pdf->SetFont('Arial', '', 15);
            $org = '@ ' . $ses_4['organization'];
            $pres = 'by ' . $ses_4['full_presenters'];
            if (empty($ses_4['organization'])) {
                $org = '';
                $pres = '';
            }
            $pdf->Cell(0, $lineSpacing, $org, 0, 2, "L");
            $pdf->Cell(0, $lineSpacing, $pres, 0, 1, "L");

        }

        $pdf->Output('roomSigns.pdf', 'I');
        break;

}
?>
