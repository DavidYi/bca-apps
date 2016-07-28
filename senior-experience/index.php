<?php
/**
 * Created by PhpStorm.
 * User: macbook
 * Date: 12/14/15
 * Time: 1:04 PM
 */

/* These messages are used to customize the login page. */
$pageTitle = 'Senior Expositions';
$loginInfo = '<h1>Senior Expo</h1>
                <h2>
                    BCA will hold Senior Expositions on <b>June 1</b>.  
                </h2>
                <h2>
                    This app is brought to you by the students of BCA.
                </h2>';


/* This call back function is called once the user is authenticated.  This function handles redirecting the user
 to their home page. */
//function directToHomePage() {
//    $user = $_SESSION['user'];
//
//    if ($user->getRole('SENX') == 'ADM') {
//        header("Location: admin");
//    } else {
//        header("Location: senior");
//    }
//}

/** Include the database credentials and then transfer control to /shared/index,
 * which contains the meat of the login handling code.
 */
require_once("util/main.php");
//include (__DIR__ . "/model/database.php");
//include (__DIR__ . "/../shared/index.php");
include (__DIR__ . "/../shared/login/index.php");
?>