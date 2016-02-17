<?php
/**
 * Created by PhpStorm.
 * User: macbook
 * Date: 2/17/16
 * Time: 10:36 AM
 */

require_once ("../../util/main.php");
require_once ("model/admin_db.php");

$rm_list = get_room_list();
include ("view.php");
exit();