<?php
/**
 * Created by PhpStorm.
 * User: celinaperalta
 * Date: 10/5/16
 * Time: 09:26
 */

require_once("../../util/main.php");
require_once("../../model/teacher_db.php");


$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        include("view.php");
    }
}

switch ($action) {
    case 'generate_teachers_csv':

        $test_list = get_active_tests_teachers();

        $output = fopen('php://output', 'w') or die("Can't open file");
        header("Content-Type:application/csv");
        header('Content-Disposition: attachment; filename="proctoring_list.csv";');

        $output = fopen('php://output', 'w');

        fputcsv($output, array('Test Name', 'Test Time', 'Last Name', 'First Name'));
        foreach ($test_list as $test) {
            fputcsv($output, $test);
        }
        fpassthru($output);
        fclose($output) or die("Can't close file");
        exit();
        break;

    default:
        display_error('Unknown account action: ' . $action);
        exit();
        break;
}

?>