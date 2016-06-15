<?php
/**
 * Created by PhpStorm.
 * User: macbook
 * Date: 1/5/16
 * Time: 2:04 PM
 */

require_once(__DIR__ . "/../util/main.php");
require_once(__DIR__ . "/../../shared/model/user_db.php");
require_once(__DIR__ . "/../model/teacher_db.php");
require_once(__DIR__ . "/../model/times_db.php");

verify_logged_in();

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

switch($action){
    case "logout":
        session_destroy();
        header("Location: ../index.php");
        break;
    case "modify_times":
        include('../Student/times/view.php');
        break;
    case "update_times":
        /*
    echo "submit";
    echo var_dump($_POST);
    */
        echo "update_times test through teacher";
        $timesString = "";
        if(filter_has_var(INPUT_POST, 'time')) {
            $timesarr = $_POST['time'];

            for ($i = 0; $i < sizeof($timesarr); $i++) {
                $timesString .= $timesarr[$i];

                if ($i + 1 != sizeof($timesarr)) {
                    $timesString .= ", ";
                } else $timesString .= ".";
            }
        }

        $timesString .= "THAT WAS INPUT FROM LAST PAGE, NEXT IS INPUT FROM DATABASE:\n";
        //Everything below is still in progress. Eventually it will replace the stuff above

        $usr_id = get_usr_id($user->usr_first_name, $user->usr_last_name);
        echo "this user's id is: ";
        echo ($usr_id); //This works YAY

        //will add_course(usr_id, timesString) which will use convert(timesString)
        //that's what I'm working on right now




        $oldtimesarr = get_times($usr_id);

        for($i = 0; $i < count($oldtimesarr); $i++){ //count($oldtimesarr) returning larger values than expected
            $timesString .= $oldtimesarr[$i]['day']; //need to figure out how to incorporate index
            $timesString .= " ";
            $timesString .= $oldtimesarr[$i]['mods'];
            $timesString .= " ";
            //I THINK THE ABOVE WORKS!!!!
            //It at least works for Sarah Abdelaziz since I inputted times for her


        }

        ?>
        <form timesString=<?php echo $timesString?> method="POST">
        </form>

        <?php
        $courses = get_course_by_user($user->usr_id);

        include('./view.php');
        break;
    /*The fact that nothing prints from this isn't an error, the database doesn't have any times inputted for most people*/
    default:
        $courses = get_course_by_user($user->usr_id);

        include("./view.php");
}


