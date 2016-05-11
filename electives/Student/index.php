<?php

/**
 * Created by PhpStorm.
 * User: joshClune
 * Date: 4/6/16
 * Time: 10:36 AM
 */
include('../util/main.php');
require_once('../model/times_db.php');


$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'list_options';
    }
}

$timesString = strtolower(filter_input(INPUT_POST, 'timesString'));
if( $timesString == NULL) {
    $timesString = strtolower(filter_input(INPUT_GET, 'timesString'));
    if( $timesString == NULL) {
        $timesString = "";
    }
}


switch ($action) {
    case 'list_options':
        include('./view.php');
        break;
    case 'modify_courses':
        echo "will make a modify_courses page later";
        include('./courses/index.php');
        break;
    case 'modify_times':
        include('./times/view.php');
        break;
    case 'logout':
        echo "will make a logout page later";
        break;
    case 'update_times':
        $timesString = "";
        if(filter_has_var(INPUT_POST, 'time')) {
            $timesarr = $_POST['time'];

            for($i = 0; $i < sizeof($timesarr); $i++){
                $timesString .= $timesarr[$i];

                if($i + 1 != sizeof($timesarr)){
                    $timesString .= ", ";
                }
                else $timesString .= ".";
            }
        }

        echo(get_usr_id("Sarah", "Abdelaziz"));
?>
        <form timesString=<?php echo $timesString?> method="POST">
        </form>

<?php
        include('./view.php');
        break;
    default:
        display_error('Unknown account action: ' . $action);
        exit();
        break;
}
?>
