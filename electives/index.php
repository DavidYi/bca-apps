<?php
/**
 * Created by PhpStorm.
 * User: macbook
 * Date: 12/14/15
 * Time: 1:04 PM
 */

/* These messages are used to customize the login page. */
$pageTitle = 'Off-Hour Electives';
$loginInfo = '<h1>Off-Hour Electives</h1>
                <h2>
                    Schedule electives during your free mods. 
                </h2>
                <h2>
                    This app is brought to you by the students of ATCS.
                </h2>';


/* This call back function is called once the user is authenticated.  This function handles redirecting the user
 to their home page. */
//function directToHomePage() {
//    $user = $_SESSION['user'];
//
//    echo $user;
//
//    if ($user->getRole('OELE') == 'ADM') {
//        header("Location: admin");
//    } elseif ($user->usr_type_cde == 'TCH'){
//        header("Location: teacher");
//    } else {
//        header("Location: student");
//    }
//}

/** Include the database credentials and then transfer control to /shared/index,
 * which contains the meat of the login handling code.
 */

require_once("util/main.php");
include (__DIR__ . "/../shared/login/index.php");

?>