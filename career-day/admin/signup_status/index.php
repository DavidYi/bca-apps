<?php

include('../../util/main.php');
include('../../model/signup_status_db.php');

verify_admin();

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'display_status';
    }
}
$result = "";

switch($action) {
    case "presentation_status":
        $student_list = presentations_registration_status();
        $output = fopen('php://output', 'w') or die("Can't open file");
        header("Content-Type:application/csv");
        header('Content-Disposition: attachment; filename="presentations.csv";');
        fputcsv($output, array('Session', 'Room', 'Field', 'Organization', 'Description', 'Presenter', 'Currently Enrolled', 'Max Seats',
            'Spots Left','Host Teacher'));
        foreach($student_list as $student) {
            fputcsv($output, $student);
        }
        fpassthru($output);
        fclose($output) or die("Can't close file");
        exit();
        break;
    case "all_registrants":
        $grade = filter_input(INPUT_POST, 'grade');
        $student_list = all_registrants_download();
        $output = fopen('php://output', 'w') or die("Can't open file");
        header("Content-Type:application/csv");
        header('Content-Disposition: attachment; filename="all_registrations.csv";');

        fputcsv($output, array('Last', 'First', 'Grade', 'Session', 'Room', 'Field', 'Title', 'Organization', 'Location', 'Presenting', 'Presentation ID', 'Field ID', 'User ID'));
        foreach($student_list as $student) {
            fputcsv($output, $student);
        }
        fpassthru($output);
        fclose($output) or die("Can't close file");
        exit();
        break;
    case "auto_enroll":
        $grade = filter_input(INPUT_POST, 'grade');
        if ($grade == NULL) {
            $grade = filter_input(INPUT_GET, 'grade');
            if ($grade == NULL) {
                $grade = 'Invalid input.';
            }
        }
        random_enroll($grade);
        $enroll_list = get_registered_users();
        include 'view.php';
        break;
    case "undo_auto_enroll":
        $grade = filter_input(INPUT_POST, 'grade');
        if ($grade == NULL) {
            $grade = filter_input(INPUT_GET, 'grade');
            if ($grade == NULL) {
                $grade = 'Invalid input.';
            }
        }
        undo_enroll($grade);
        $enroll_list = get_registered_users();
        include 'view.php';
        break;
    case "display_status":
        $enroll_list = get_registered_users();
        include 'view.php';
        break;
    case "all_download":
        $grade = filter_input(INPUT_POST, 'grade');
        $student_list = all_enroll_download($grade);
        $output = fopen('php://output', 'w') or die("Can't open file");
        header("Content-Type:application/csv");
        header('Content-Disposition: attachment; filename="all_enrolled.csv";');

        fputcsv($output, array('Last','First','Username','Year','Number of Sessions'));
        foreach($student_list as $student) {
            fputcsv($output, $student);
        }
        fpassthru($output);
        fclose($output) or die("Can't close file");
        exit();
        break;
    case "partial_download":
        $grade = filter_input(INPUT_POST, 'grade');
        $student_list = partial_enroll_download($grade);
        $output = fopen('php://output', 'w') or die("Can't open file");
        header("Content-Type:application/csv");
        header('Content-Disposition: attachment; filename="partial_enrolled.csv";');

        fputcsv($output, array('Last','First','Username','Year','Number of Sessions'));
        foreach($student_list as $student) {
            fputcsv($output, $student);
        }
        fpassthru($output);
        fclose($output) or die("Can't close file");
        exit();
        break;
    case "no_download":
        $grade = filter_input(INPUT_POST, 'grade');
        $student_list = no_enroll_download($grade);
        $output = fopen('php://output', 'w') or die("Can't open file");
        header("Content-Type:application/csv");
        header('Content-Disposition: attachment; filename="not_enrolled.csv";');

        fputcsv($output, array('Last','First','Username','Year','Number of Sessions'));
        foreach($student_list as $student) {
            fputcsv($output, $student);
        }
        fpassthru($output);
        fclose($output) or die("Can't close file");
        exit();
        break;
    case "mentor_download":
        $student_list = mentor_download();
        $output = fopen('php://output', 'w') or die("Can't open file");
        header("Content-Type:application/csv");
        header('Content-Disposition: attachment; filename="mentor.csv";');

        fputcsv($output, array('Last','First','Field','Position','Company', 'Room', 'Host', 'Timeslot', 'Max', 'Enrolled', 'Remaining'));
        foreach($student_list as $student) {
            fputcsv($output, $student);
        }
        fpassthru($output);
        fclose($output) or die("Can't close file");
        exit();
        break;

    default:
        display_error("Invalid action: " . $action);
        break;
    }
?>
