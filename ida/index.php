<?php
/**
 * Created by PhpStorm.
 * User: macbook
 * Date: 12/14/15
 * Time: 1:04 PM
 */

/* These messages are used to customize the login page. */
$pageTitle = 'IDA Registration';
$loginInfo = '<h1>International Day of Acceptance</h1>
                <h2>
                    BCA will celebrate IDA on <b>Thursday, January 26th</b>. During IDA, you will have the opportunity
                    to participate in 2 different presentations, helping us to deepen our understanding of 
                    diversity.  
                </h2>
                <h2>
                    This app is brought to you by the students of BCA.
                </h2>';


/* This call back function is called once the user is authenticated.  This function handles redirecting the user
 to their home page. */
//function directToHomePage() {
//    $user = $_SESSION['user'];
//
//    if ($user->getRole('IDA') == 'ADM') {
//        header("Location: admin");
//    } else {
//        header("Location: itinerary");
//    }
//}

/** Include the database credentials and then transfer control to /shared/index,
 * which contains the meat of the login handling code.
 */
require_once("util/main.php");
//include (__DIR__ . "/../shared/index.php");
include (__DIR__ . "/../shared/login/index.php");

?>