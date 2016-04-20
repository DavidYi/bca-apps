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
	                <h3>
						Create and schedule electives during your free mods.
					</h3>
					<h3>
						This app is brought to you by the students of ATCS.
					</h3>';


/* This call back function is called once the user is authenticated.  This function handles redirecting the user
 to their home page. */
function directToHomePage() {
    $user = $_SESSION['user'];

    if ($user->getRole('SENX') == 'ADM') {
        header("Location: admin");
    } else {
        header("Location: senior");
    }
}

/** Include the database credentials and then transfer control to /shared/index,
 * which contains the meat of the login handling code.
 */

include (__DIR__ . "/model/database.php");
include (__DIR__ . "/../shared/index.php");

?>