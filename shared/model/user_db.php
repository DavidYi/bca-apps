<?php

//Authenticate a username and password to Bergen Techs AD
//Username must be in UPN format username@bergen.org
//Returns True on sucess
//Returns False on any fails
function bergenAuthLDAP($username, $password)
{
    $ad = ldap_connect("168.229.1.240", 3268);

    if ($ad === FALSE)
        return false;

    if (empty($password))
        return false;

    ldap_set_option($ad, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ad, LDAP_OPT_REFERRALS, 0);

    //Test user creds
    if ( @ldap_bind($ad, $username . '@bergen.org', $password) )
        return true;
    else
        return false;
}

function get_user_by_username($username, $app_cde) {
    $query = 'SELECT user.usr_id, usr_bca_id, usr_type_cde, usr_role_cde, usr_class_year, usr_first_name, usr_last_name, usr_active
              FROM user
              LEFT OUTER JOIN role_application_user_xref ON user.usr_id = role_application_user_xref.usr_id
              and app_cde = :app_cde
              WHERE usr_bca_id =  :username';

    global $db;

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':app_cde', $app_cde);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
        exit();
    }
}

function get_user($usr_id, $app_cde) {
    $query = 	'SELECT user.usr_id, usr_bca_id, usr_type_cde, usr_role_cde, usr_class_year, usr_first_name, usr_last_name, usr_active
                  FROM user
                  LEFT OUTER JOIN role_application_user_xref ON user.usr_id = role_application_user_xref.usr_id
                  and app_cde = :app_cde
                  WHERE user.usr_id = :usr_id';

    global $db;

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':usr_id', $usr_id);
        $statement->bindValue(':app_cde', $app_cde);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
        exit();
    }
}

function get_user_list() {
    $query = 'SELECT usr_id, usr_bca_id, usr_type_cde, usr_class_year,
                 usr_first_name, usr_last_name, usr_active
              from user
              where usr_active = 1
			  order by usr_display_name';

    return get_list($query);
}

?>