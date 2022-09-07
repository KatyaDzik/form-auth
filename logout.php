<?php
session_start();
include 'login_class.php';
unset($_SESSION['name']);
setcookie( "login", "", time()- 60, "/","", 0);
header('Location: login.php');

?>