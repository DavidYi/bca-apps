<?php
/**
 * Created by PhpStorm.
 * User: macbook
 * Date: 12/14/15
 * Time: 1:04 PM
 */

/* These messages are used to customize the login page. */
$pageTitle = 'Off-hour Electives';
$loginInfo = '<h1>Off-hour Electives</h1>
	                <h3>
						Schedule electives during your free mods. 
					</h3>
					<h3>
						This app is brought to you by the students of ATCS.
					</h3>';


/* This call back function is called once the user is authenticated.  This function handles redirecting the user
 to their home page. */
function directToHomePage() {
    $user = $_SESSION['user'];

    echo $user;

    if ($user->getRole('OELE') == 'ADM') {
        header("Location: admin");
    } elseif ($user->usr_type_cde == 'TCH'){
        header("Location: teacher");
    } else {
        header("Location: student");
    }
}

/** Include the database credentials and then transfer control to /shared/index,
 * which contains the meat of the login handling code.
 */

include (__DIR__ . "/model/database.php");
include (__DIR__ . "/../shared/login/index.php");

?>