<?php
require("register_class.php");
if(isset($_POST['username']))
{	
$user = new RegisterUser($_POST['username'],$_POST['userlogin'],$_POST['useremail'], $_POST['userpassword'], $_POST['userpassword2']);
}
?>

