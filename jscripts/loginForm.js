$("#searchUser").on("click", function(e){
    e.preventDefault();
    let userlogin = $("#userlogin").val().trim();
    let userpassword = $("#userpassword").val().trim();

    if(userlogin.length<6){
        $("#login_error").text("Login must contain six or more characters");
        return false;
    }else{
        $("#login_error").text("");
    }
    
    if(userpassword.length<6){
        $("#password_error").text("Password must contain six or more characters");
        return false;
    }else{
        $("#password_error").text("");
    }

    if(/\d/.test(userpassword)==false || /[a-zA-Z]/.test(userpassword)==false || /[.*+?^:;@!#^%&${}'()|[\]\\]/.test(userpassword)==true){
        $("#password_error").text("Password must contain only numbers and letters");
        return false;
    }else{
        $("#password_error").text("");
    }

    $.ajax({
        url: 'login_class.php',
        type: 'POST',
        cache: false,
        data:{'userlogin': userlogin, 'userpassword': userpassword},
        dataType: 'html',
        success: function(data){
            var obj = JSON.parse(data);
            if(obj.status=="errorlogin")
            {
                $("#login_error").text(obj.message);
               return false;
            }else if(obj.status=="errorpass")
            {
                $("#password_error").text(obj.message);
                return false;
            }else if(obj.status=="success"){
                document.getElementById("userlogin").value = "";
                document.getElementById("userpassword").value = "";
            }
        },
        error: function() {
            alert('There was some error performing the AJAX call!');
          }

    });
})