<?php 
	require_once("../util/main.php");
	require_once("../model/teacher_db.php");


	$trips = get_trip_by_user($user->usr_id);

    include("view.php");
?>

