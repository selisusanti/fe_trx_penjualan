usernameForgetPassword.on('change', function(e){
    var username = usernameForgetPassword.val();
    usernameForgetPassword.addClass('disabled');
    loader.removeClass('hide');

    $.ajax({
        type: 'GET',
        data: {
            "string": username
        },
        async: true,
        dataType: 'json',
        url: "/auth/checkUser",
        success: function(data){
            if(data.status !== undefined){ 
                if(data.code == "UMA0014"){
                    $('#username-error-message').addClass("invisible");
                    triggerTabVerification();
                }else{
                    $('#username-error-message').removeClass("invisible");
                    $('#username-error-message').html(data.message);
                    lockNextButton();
                }
            }else{
                $('#username-error-message').addClass("invisible");
                triggerTabVerification();
            }

            $('#loader').addClass('hide');
            usernameForgetPassword.removeClass('disabled');
        },
        error: function(xhr, status, error) {
            $('#loader').addClass('hide');
            usernameForgetPassword.removeClass('disabled');

            if(xhr.status === 404){
                customSwal(xhr.status+ " - " + xhr.statusText, 'Requested URL is not found!');
            }else{
                customSwal(xhr.status+ " - " + xhr.statusText, "Connection to system is error! Please contact system administrator!");
            }
        }
    });
});
