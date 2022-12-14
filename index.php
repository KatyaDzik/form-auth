<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Register Form</title>
</head>
<body>
    <?php
     session_start();
     if (isset($_SESSION['name']) && isset($_COOKIE['login'])) {
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

    <form id="regForm" style="display: none" method="post">
        <h2>Register Form</h2>
    
        <input type="text" id="username" name="username" placeholder="Name">
        <p id="name_error" class="msg_error"></p>

        <input type="text" id="userlogin" name="userlogin" placeholder="Login">
        <p id="login_error" class="msg_error"></p>

        <input type="email" id="useremail" name="useremail" placeholder="Email">
        <p id="email_error" class="msg_error"></p>
    
        <input type="password" id="userpassword" name="userpassword" placeholder="Password">
        <p id="password_error" class="msg_error"></p>

        <input type="password" id="userpassword2" name="userpassword2"  placeholder="Confirm Password">
        <p id="confirm_password_error" class="msg_error"></p>

        <p class="msg_error"><?php echo $_SESSION['msgnotmatch'];
                                    unset($_SESSION['msgnotmatch']);?></p>
        <button type="submit" id="sendUser" name="submit">Register</button>

        <p class="href">Already have an account? <a href="login.php">Sign in</a></p>
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="jscripts/registrForm.js"></script>
    <script type="text/javascript">document.getElementById( 'regForm' ).style.display = 'flex';</script>
    <script src="jscripts/logout.js"></script>
</body>
</html>