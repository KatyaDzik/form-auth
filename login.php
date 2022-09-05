<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Log in Form</title>
</head>
<body>
<?php
    
   /* require("login_class.php");
    if(isset($_POST['submit'])){
       $user = new LoginUser($_POST['userlogin'], $_POST['userpassword']);
    }*/
?>

    <form method="post">
      <h2>Log in Form</h2>
      <input type="text" id="userlogin" name="userlogin" placeholder="Login">
      <p id="login_error" class="msg_error"></p>

      <input type="password" id="userpassword" name="userpassword" placeholder="Password">
      <p id="password_error" class="msg_error"></p>

      <button type="submit" id="searchUser" name="submit">Log in</button>

      <p class="href">Don't have an account? <a href="index.php">Sign up</a></p>

   </form>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="jscripts/loginForm.js"></script>
</body>
</html>