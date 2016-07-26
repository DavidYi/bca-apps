<?php
/**
 * Created by PhpStorm.
 * User: macbook
 * Date: 12/14/15
 * Time: 1:04 PM
 */

/* These messages are used to customize the login page. */
$pageTitle = 'Career Day Registration';
$loginInfo = '<h1>Career Day </h1>
                <h2>
                    BCA will hold Career Day on <b>Tuesday, February 2</b>.  At Career Day, you will have the opportunity
                    to participate in presentations by 4 different mentors of your choosing.  Through this experience,
                    our hope is that you can gain insight into the variety and types of career paths available to you.
                </h2>
                <h2>
                This app is brought to you by the students of ATCS.
                </h2>';


/* This call back function is called once the user is authenticated.  This function handles redirecting the user
 to their home page. */
function directToHomePage() {
    $user = $_SESSION['user'];

    if ($user->getRole('CAR') == 'ADM') {
        header("Location: admin");
    } else {
        header("Location: itinerary");
    }
}

/** Include the database credentials and then transfer control to /shared/index,
 * which contains the meat of the login handling code.
 */
require_once("util/main.php");
include (__DIR__ . "/../shared/login/index.php");

?>