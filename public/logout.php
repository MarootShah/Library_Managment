<?php
require_once('../app/config/config.php');

/* remove all session variables */
$_SESSION = [];

/* destroy session */
session_destroy();

if(!isset($_SESSION["user"])){
    
    header("Location: login.php");
    exit();
}

/* redirect to login page */
//header("Location: login.php");
exit();
?>