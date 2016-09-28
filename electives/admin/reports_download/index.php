<?php
require_once ("../../util/main.php");
require_once (__DIR__ . "/../../../shared/model/user_db.php");
require_once (__DIR__ . "/../../../shared/model/database.php");
require_once("../../model/admin_db.php");
require_once("../../model/student_db.php");


$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'show_downloads';
    }
}

switch ($action) {

    case 'show_downloads':
        $availability_list = get_best_course_availability();

        include('view.php');
        break;

    case "availability_matrix_download":
        //$student_list = mentor_download();
        $availability_list = get_best_course_availability();

        $output = fopen('php://output', 'w') or die("Can't open file");
        header("Content-Type:application/csv");
        header('Content-Disposition: attachment; filename="availability_matrix.csv";');

        fputcsv($output, array('Course ID', 'Course Name', 'Times', 'Students'));
        foreach ($availability_list as $item) {
            fputcsv($output, $item);
        }
        fpassthru($output);
        fclose($output) or die("Can't close file");
        exit();
        break;

    case "electives_list_download": //There's a weird duplication thing going on -- will fix later.
        $electives_list = get_elective_list(2,2);

        $output = fopen('php://output', 'w') or die("Can't open file");
        header("Content-Type:application/csv");
        header('Content-Disposition: attachment; filename="electives_list.csv";');

        fputcsv($output, array('Teacher Name', 'Course Name', 'Course Description', '# of Students'));
        foreach ($electives_list as $elective) {
            fputcsv($output, $elective);
        }
        fpassthru($output);
        fclose($output) or die("Can't close file");
        exit();

        break;

    case "availability_list_download":
        $availability_list = get_free_mods();

        $output = fopen('php://output', 'w') or die("Can't open file");
        header("Content-Type:application/csv");
        header('Content-Disposition: attachment; filename="availability.csv";');

        fputcsv($output, array("User ID", "First", "Last", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday"));
        foreach ($availability_list as $item) {
            fputcsv($output, $item);
        }
        fpassthru($output);
        fclose($output) or die("Can't close file");
        exit();
        break;

    case "course_interest_download":
        $student_list = course_interest_download();

        $output = fopen('php://output', 'w') or die("Can't open file");
        header("Content-Type:application/csv");
        header('Content-Disposition: attachment; filename="course_interest.csv";');

        fputcsv($output, array("User ID", "Last", "First", "Course ID", "Course Name"));
        foreach ($student_list as $student) {
            fputcsv($output, $student);
        }
        fpassthru($output);
        fclose($output) or die("Can't close file");
        exit();
        break;
}