<?php
include('dbconnect.php');
//destroy all the session
session_destroy();
//redirect to login page
header('location:'.SITEURL.'login.php');
?>