<?php
require_once('../../util/main.php');
require_once('../../model/mentor_admin_db.php');

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
    

}
?>