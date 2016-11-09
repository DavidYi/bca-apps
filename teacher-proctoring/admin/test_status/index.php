<?php
/**
 * Created by PhpStorm.
 * User: macbook
 * Date: 1/5/16
 * Time: 2:04 PM
 */

require_once("../../util/main.php");
require_once("../../model/teacher_db.php");

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'list_admin_tests';
    }
}

if(!isset($_SESSION['filter_past']))
    $_SESSION['filter_past'] = false;

switch ($action) {

    case 'list_admin_tests':

        $sort_by = filter_input(INPUT_GET, 'sort');
        if ($sort_by == NULL) {
            $sort_by = 0;
        }
        
        $sort_order = filter_input(INPUT_GET, 'order');
        if ($sort_order == NULL) {
            $sort_order = 0;
        }

        $filter_past = filter_input(INPUT_POST, 'past_button');
        if (!empty($filter_past)) {
            $_SESSION['filter_past'] = !$_SESSION['filter_past'];
        }
        $past_num = $_SESSION['filter_past'] ? 1 : 0;

        $testList = get_test_list($user->usr_id, $sort_by, $sort_order, 1, $past_num);

        $teacher_data = array();

        foreach ($testList as $test) {
            $teachList = get_teachers_from_test($test['test_id'], $test['test_time_id']);
            $id = $test['test_id'] . ', ' . $test['test_time_id'];
            $teacher_data[$id] = $teachList;
        }

        include "view.php";
        break;

    case 'listpdf':
        /*
        $test_id = filter_input(INPUT_POST, 'test_id');
        $session_id = filter_input(INPUT_POST, 'session');
        $presentations = get_presentation_list($mentor_id, $session_id);
        $header = array("Year", "Academy", "Name", "Signature");
        $pdf = new listPDF();

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
*/
        $pdf->Output('listPDF.pdf', 'I');
        break;

    default:
        echo('Unknown account action: ' . $action);
        break;

}

verify_logged_in();

$action = filter_input(INPUT_GET, 'action');
if (isset($action) and ($action == "logout")) {
    if (isset($_SESSION['prev_usr_id'])) {
        $_SESSION['user'] = User::getUserByUsrId($_SESSION['prev_usr_id']);
        $_SESSION['prev_usr_id'] = NULL;
        header("Location: ../admin/index.php");
    } else {
        session_destroy();
        header("Location: ../index.php");
    }
}

exit();