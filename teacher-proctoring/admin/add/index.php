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
		$testList = get_test_list($user->usr_id, 0, 0, 0, 0);
		break;
	
	case 'add_test':
		$error_msg = '';

        $choice = filter_input(INPUT_POST, 'choice');
        $test_name = filter_input(INPUT_POST, 'test_name');
        $date = filter_input(INPUT_POST, 'date');
        
        $one_three = intval(filter_input(INPUT_POST, 'one_three'));
        $four_six = intval(filter_input(INPUT_POST, 'four_six'));
        $seven_nine = intval(filter_input(INPUT_POST, 'seven_nine'));
        $ten_twelve = intval(filter_input(INPUT_POST, 'ten_twelve'));
        $thirteen_fifteen = intval(filter_input(INPUT_POST, 'thirteen_fifteen'));
        $sixteen_eighteen = intval(filter_input(INPUT_POST, 'sixteen_eighteen'));
        $nineteen_twentyone = intval(filter_input(INPUT_POST, 'nineteen_twentyone'));
        $twentytwo_twentyfour = intval(filter_input(INPUT_POST, 'twentytwo_twentyfour'));
        $twentyfive_twentyseven = intval(filter_input(INPUT_POST, 'twentyfive_twentyseven'));
        $test_cde = filter_input(INPUT_POST, 'test_cde');
        $room_id = filter_input(INPUT_POST, 'room_id');

        $proc_times = [$one_three, $four_six, $seven_nine, $ten_twelve,
            $thirteen_fifteen, $sixteen_eighteen, $nineteen_twentyone,
            $twentytwo_twentyfour, $twentyfive_twentyseven];

        if ($choice == 'Add') {
            $missing_proctors = true;
            if (empty($test_name)) $error_msg .= "Test Name is required.<BR>";
            if (empty($date)) $error_msg .= "Date is required.<BR>";
            if (empty($test_cde)) $error_msg .= "Test Type is required.<BR>";
            if (empty($room_id)) $error_msg .= "Room is required.<BR>";
            foreach ($proc_times as $proc_time) {
                if ($proc_time != 0) {
                    $missing_proctors = false;
                    break;
                }
            }
            if ($missing_proctors) $error_msg .= "At least one hour needs a 
                proctor count greater than zero.<BR>";
            
            if ($error_msg != "") {
                echo $error_msg;
            } else {
                $date = explode("/", $date);
                $datetime = $date[2].'-'.$date[0].'-'.$date[1];
                add_test($test_name, $datetime, $test_cde, $room_id, $proc_times);
            }
        }

        break;

	default:
        display_error('Unknown teacher action: ' . $action);
        break;
}

include ("view.php");

?>