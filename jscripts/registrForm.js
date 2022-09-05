$("#sendUser").on("click", function(){
    let username = $("#username").val().trim();
    let userlogin = $("#userlogin").val().trim();
    let useremail = $("#useremail").val().trim();
    let userpassword = $("#userpassword").val().trim();
    let userpassword2 = $("#userpassword2").val().trim();

    if(username.length<2){
        console.log("kkk");
        $("#name_error").text("Name must contain two or more characters");
        return false;
    } else {
        $("#name_error").text("");
    }

    if (/\d/.test(username) || /[.*+?^:;@!#^%&${}'()|[\]\\]/.test(username)) {
        $("#name_error").text("Name must contain only characters");
        return false;
    } else {
        $("#name_error").text("");
    }


    if(userlogin.length<6){
        $("#login_error").text("Login must contain six or more characters");
        return false;
    }else{
        $("#login_error").text("");
    }
    
    if(useremail===""){
        $("#email_error").text("Enter email");
        return false;
    } else {
        $("#email_error").text("");
    }


    if(/^(([^<>()[\].,;:\s@"]+(\.[^<>()[\].,;:\s@"]+)*)|(".+"))@(([^<>()[\].,;:\s@"]+\.)+[^<>()[\].,;:\s@"]{2,})$/iu.test(useremail)==false){
        $("#email_error").text("Email isn\'t correct");
        return false;
    }

    if(userpassword.length<6){
        $("#password_error").text("Password must contain six or more characters");
        return false;
    }else{
        $("#password_error").text("");
    }

    if(/\d/.test(userpassword)==false || /[a-zA-Z]/.test(userpassword)==false || /[.*+?^:;@!#^%&${}'()|[\]\\]/.test(userpassword)==true){
        $("#password_error").text("Name must contain only numbers and letters");
        return false;
    }else{
        $("#password_error").text("");
    }

    if(userpassword!==userpassword2)
    {
        $("#confirm_password_error").text("Passwords do not match");
        return false;
    }else{
        $("#onfirm_password_error").text("");
    }

    $.ajax({
        url: 'h.php',
        type: 'POST',
        cache: false,
        data:{'username': username, 'userlogin': userlogin, 'useremail': useremail, 'userpassword': userpassword, 'userpassword2': userpassword2},
        dataType: 'html',
        success: function(data){
            alert('mmmm');
        }

    });
})