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
     session_start();
     if (isset($_SESSION['name'])) {
         echo "<div class='greetings'>".
         "<h1>"."Hello, ".$_SESSION['name']."</h1>".
         "<button type='submit' id='logout' name='logout'>Log out</button>".
         "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
          <script src='jscripts/registrForm.js'></script><script src='jscripts/logout.js'></script>".
         "</div>";
         exit();
     }
    ?>
    <noscript>
      You cannot register without javascript enabled.
    </noscript>

    <form id="logForm" style="display: none" method="post">
      <h2>Log in Form</h2>
      <input type="text" id="userlogin" name="userlogin" placeholder="Login">
      <p id="login_error" class="msg_error"></p>

      <input type="password" id="userpassword" name="userpassword" placeholder="Password">
      <p id="password_error" class="msg_error"></p>

      <button type="submit" id="searchUser" name="submit">Log in</button>

      <p class="href">Don't have an account? <a href="index.php">Sign up</a></p>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="jscripts/loginForm.js"></script>
    <script src="jscripts/logout.js"></script>
    <script type="text/javascript">document.getElementById( 'logForm' ).style.display = 'flex';</script>
   </form>
</body>
</html>