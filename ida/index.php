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
                <h3>
                    BCA will celebrate IDA on <b>[DATE]</b>. During IDA, you will have the opportunity
                    to participate in 2 different presentations. [CONTINUED DESCRIPTION]
                </h3>
                <h3>
                    This app is brought to you by the students of ATCS.
                </h3>';


/* This call back function is called once the user is authenticated.  This function handles redirecting the user
 to their home page. */
function directToHomePage() {
    $user = $_SESSION['user'];

    if ($user->getRole('IDA') == 'ADM') {
        header("Location: admin");
    } else {
        header("Location: itinerary");
    }
}

/** Include the database credentials and then transfer control to /shared/index,
 * which contains the meat of the login handling code.
 */
require_once("util/main.php");
include (__DIR__ . "/../shared/index.php");

?>