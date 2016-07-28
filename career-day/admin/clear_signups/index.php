<?php
require_once('../../util/main.php');
require_once('../../model/signups_db.php');

verify_admin();

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'view_page';
    }
}

switch ($action) {
    case('view_page'):
        include 'view.php';
        break;
    case 'delete_all':
        $choice = filter_input(INPUT_POST, 'choice');

        if ($choice == 'Delete') {
            if(isset($_POST['box1'])){
                if(isset($_POST['box2'])){
                    clear_signups();
                    header("Location: complete.php");
                    break;
                }
            }
        }
        header("Location: ..");
        break;

}
?>