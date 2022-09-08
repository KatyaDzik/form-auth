$("#logout").on("click", function(){
    console.log('here');
    $.ajax({
        url: 'login_class.php',
        type: 'POST',
        cache: false,
        data: {},
        dataType: 'html',
        success: function(){
           location.reload();
        },
        error: function() {
            alert('There was some error performing the AJAX call!');
          }

    });
})