<?php
<<<<<<< HEAD
/**
 * Created by PhpStorm.
 * User: joshClune
 * Date: 4/6/16
 * Time: 10:36 AM
 */
echo "This is the index.php in Student"
=======
include('../util/main.php');

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'list_options';
    }
}

//we don't include verify_admin() function here because this is the student side

switch ($action) {
    case 'list_options':
        include('Student/view/index.php');
        break;
    case 'modify_courses':
        echo "modify_courses";
        break;
    case 'modify_times':
        echo "modify_times";
        break;
    default:
        display_error('Unknown account action: ' . $action);
        exit();
        break;
}
>>>>>>> 0df83cfd13f2c74bff6cd6204d2803ed3fba473a
?>