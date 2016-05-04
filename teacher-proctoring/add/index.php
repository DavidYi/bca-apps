<?php
require_once("../util/main.php");
require_once("../model/teacher_db.php");
$testTypes = get_test_types();
$rooms = get_rooms();

include("view.php");

// function add_test($test_id, $test_type_cde, $rm_id, $test_name, $test_dt){
//   $query = '';
//   $global db;
//
//   try{
//     $statement = $db->prepare($query);
//     $statement->bindValue(":test_id", $test_id, PDO::PARAM_STR);
//     $statement->bindValue(":$test_type_cde", $test_type_cde, PDO::PARAM_INT);
//     $statement->bindValue(":$rm_id", $rm_id, PDO::PARAM_INT);
//     $statement->bindValue(":$test_name", $test_name, PDO::PARAM_STR);
//     $statement->bindValue(":$test_dt", $test_dt, PDO::PARAM_STR);
//
//     $statement->execute();
//     $statement->closeCursor();
//   } catch (PDOException $e){
//     display_db_exception($e);
//     exit();
//   }
// }
?>
