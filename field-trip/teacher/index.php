<?php 
	require_once("../util/main.php");
	require_once("../model/teacher_db.php");


	$trips = get_trip_by_user($user->usr_id);
	$students_missing = students_missing($user->usr_id);

	$action = strtolower(filter_input(INPUT_POST, 'action'));
	if ($action == NULL) {
		$action = strtolower(filter_input(INPUT_GET, 'action'));
		if ($action == NULL) {
			$action = 'default';
		}
	}

	if (isset($action) and ($action == "logout")) {
		if (isset($_SESSION['prev_usr_id'])) {
			$_SESSION['user'] = User::getUserByUsrId($_SESSION['prev_usr_id']);
			unset($_SESSION['prev_usr_id']);
			header("Location: ../admin/index.php");
		} else {
			session_destroy();
			header("Location: ../index.php");
		}
	}

    include("view.php");
?>

