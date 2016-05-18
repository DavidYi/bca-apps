<?php
require_once("../../util/main.php");
require_once("../../model/teacher_db.php");
$testTypes = get_test_types();
$rooms = get_rooms();

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
	$action = strtolower(filter_input(INPUT_GET, 'action'));
	if ($action == NULL) {
		$action = 'list_tests';
	}
}

switch ($action) {
	case 'list_tests':
		$testList = get_test_list();
		include '../../mainPage/index.php';
		break;
	
	case 'add_test':

		$error_msg = '';

        $choice = filter_input(INPUT_POST, 'choice');
        $test_name = filter_input(INPUT_POST, 'test_name');
        $date = filter_input(INPUT_POST, 'date');
        $date = explode("/", $date);
        $datetime = $date[2].'-'.$date[0].'-'.$date[1];
        
        $one_three = filter_input(INPUT_POST, 'one_three');
        $four_six = filter_input(INPUT_POST, 'four_six');
        $seven_nine = filter_input(INPUT_POST, 'seven_nine');
        $ten_twelve = filter_input(INPUT_POST, 'ten_twelve');
        $thirteen_fifteen = filter_input(INPUT_POST, 'thirteen_fifteen');
        $sixteen_eighteen = filter_input(INPUT_POST, 'sixteen_eighteen');
        $nineteen_twentyone = filter_input(INPUT_POST, 'nineteen_twentyone');
        $twentytwo_twentyfour = filter_input(INPUT_POST, 'twentytwo_twentyfour');
        $twentyfive_twentyseven = filter_input(INPUT_POST, 'twentyfive_twentyseven');
        $test_cde = filter_input(INPUT_POST, 'test_cde');
        $room_id = filter_input(INPUT_POST, 'room_id');


        // The user either pressed Add or Cancel.
        // If Add, then add the teacher.
        // Otherwise, just skip down to the list redraw.
        if ($choice == 'Add') {
            if (empty($test_name)) {
                $error_msg .= "Test Name is required.<BR>";
            }
            if (empty($date)) {
                $error_msg .= "Date is required.<BR>";
            }

            if ($error_msg != "") {
                include 'teacher_add.php';
                exit();
            }
            else {
                add_test ($datetime, $test_name, $test_cde, $room_id, $one_three, $four_six, $seven_nine, $ten_twelve, $thirteen_fifteen, $sixteen_eighteen, $nineteen_twentyone, $twentytwo_twentyfour, $twentyfive_twentyseven);
            }

        }

        break;

	default:
        display_error('Unknown teacher action: ' . $action);
        break;
}

include ("view.php");

?>