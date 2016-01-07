<?php
/**
 * Created by PhpStorm.
 * User: macbook
 * Date: 1/7/16
 * Time: 10:51 AM
 */

session_start();
if (isset($_SESSION['usr_id'])) {
    header('Location: itinerary/');
} else {
    header('Location: login/');
}