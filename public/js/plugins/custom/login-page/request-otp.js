//GLOBAL VARIABLE
let SAVED_TOKEN = null;

function otpNotification(type, message){
    Dashmix.helpers('notify', {
        type: type,
        icon: 'fa fa-times mr-1',
        message: message,
        placement: {
            from: "top",
            align: "center"
        },
        z_index: 100000
    });
}

function requestOTP(username){
    $('#loader').removeClass("hide");
    $.ajax({
        type: 'POST',
        url: '/auth/request-otp',
        data: {
            "userparam": username
        },
        success: function(e){
            if(e.status == true){
                otpNotification("primary", "OTP Sent!");
                requestOTPCountdown();
                $('#re-request-otp-anchor').addClass('disabled');
            }

            $('#loader').addClass("hide");
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
}

let requestOTPCountdown = function(){
    let counter = $('#countdown-expire-otp');
    counter.html("");
    lalalatime = parseFloat(tokenSession);

    let timerId = setInterval(countdown, 100);

    function countdown() {
        if (parseInt(lalalatime) === -1) {
            clearTimeout(timerId);
            $('#re-request-otp-anchor').removeClass('disabled');
            if(requestOTPCountdown == null) counter.html("");
                else counter.html("Token Expired");
        } else {
            if(requestOTPCountdown == null) lalalatime = 0;
            counter.html(parseInt(lalalatime) + ' seconds');
            lalalatime = lalalatime - 0.100;
        }
    }
}

function cancelCountdown(){
    var exe = requestOTPCountdown;
    requestOTPCountdown = null;

    setTimeout(function(){
        requestOTPCountdown = exe;
    }, 200);
}

//Submit OTP
otpTextbox.on('change', function(){
    $('#loader').removeClass('hide');

    $.ajax({
        type: "POST",
        data: {
            "username": usernameForgetPassword.val(),
            "otp_key": otpTextbox.val()
        },
        url: "/auth/submit-otp",
        success: function(e){
            if(e.status == true){
                SAVED_TOKEN = e.data;
                triggerTabPassword();
            }else{
                otpNotification("danger", "Invalid OTP! Please re-check the OTP!");
            }

            $('#loader').addClass('hide');
        },
        error: function(xhr, status, error) {
            $('#loader').addClass('hide');

            if(xhr.status === 404){
                customSwal(xhr.status+ " - " + xhr.statusText, 'Requested URL is not found!');
            }else{
                customSwal(xhr.status+ " - " + xhr.statusText, "Connection to system is error! Please contact system administrator!");
            }
        }
    });
});

