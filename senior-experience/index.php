<?php
/**
 * Created by PhpStorm.
 * User: macbook
 * Date: 12/14/15
 * Time: 1:04 PM
 */
require_once("./model/database.php");
// require_once("./model/presentations_db.php");

//Authenticate a username and password to Bergen Techs AD
//Username must be in UPN format username@bergen.org
//Returns True on sucess
//Returns False on any fails
/*function bergenAuthLDAP($username, $password)
{
    $ad = ldap_connect("ldap://bergen.org");

    if ($ad === FALSE)
        return false;

    ldap_set_option($ad, LDAP_OPT_PROTOCOL_VERSION, 4);

    //Test user creds
    if ( @ldap_bind($ad, $username . '@bergen.org', $password) )
        return true;
    else
        return false;
}
*/

//Authenticate a username and password to Bergen Techs AD
//Username must be in UPN format username@bergen.org
//Returns True on sucess
//Returns False on any fails
function bergenAuthLDAP($username, $password)
{
    $ad = ldap_connect("168.229.1.240", 3268);

    if ($ad === FALSE)
        return false;

    ldap_set_option($ad, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ad, LDAP_OPT_REFERRALS, 0);


    //Test user creds
    if ( @ldap_bind($ad, $username . '@bergen.org', $password) )
        return true;
    else
        return false;
}


$action = strtolower(filter_input(INPUT_POST, 'action'));

if (($action == NULL) || ($action != 'login' )){
    $message = "";
    include('login.php');
    exit();
}
else {
    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');

    $pos = strpos($username, "@");
    if ($pos !== false) {
        $username = substr($username,0,$pos);
    }

    if (!bergenAuthLDAP($username, $password)) {
        $message = "Username, password combination is not correct.";
        include('login.php');
        exit();
    }

    $user = get_user_by_username($username);

    //
    // need to somehow check if the user was not found.

    session_start();

    $_SESSION['usr_id'] = $user['usr_id'];
    $_SESSION['usr_role_cde'] = $user['usr_role_cde'];
    $_SESSION['usr_type_cde'] = $user['usr_type_cde'];

    if ($user['usr_role_cde'] == 'ADM') {
        // The user is an admin, so they are directed to  admin page
        header("Location: ./admin");
    } else {
        // The user is a student or teacher, they are directed to sign up page
        header("Location: itinerary");
    }
}

?>