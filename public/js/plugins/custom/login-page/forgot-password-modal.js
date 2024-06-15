//Initialization and Engine
let usernameForgetPassword = $('#forgot-password-username');

let otpTextbox = $('#forgot-password-otp');

let passwordForgetPassword = $('#forgot-password-password');
let confirmPasswordForgetPassword = $('#forgot-password-confirm-password');

let tabUsername = $('#tab-username-opener');
let tabVerification = $('#tab-verification-opener');
let tabPassword = $('#tab-password-opener');

let nextButton = $('#next-btn');
let prevButton = $('#prev-btn');
let createPasswordButton = $('#create-password')
let currentPage = 1;

let loader = $('#loader');

function initialValue(){
    usernameForgetPassword.val("");
    otpTextbox.val("");
    passwordForgetPassword.val("");
    confirmPasswordForgetPassword.val("");
}

initialValue();

function releaseNextButton(){
    nextButton.removeClass('disabled');
    nextButton.removeAttr('disabled');
}

function releaseCreatePasswordButton(){
    createPasswordButton.removeClass('disabled');
    createPasswordButton.removeAttr('disabled');
}

function lockNextButton(){
    nextButton.addClass('disabled');
    nextButton.prop('disabled', 'disabled');
}

function lockCreatePasswordButton(){
    createPasswordButton.addClass('disabled');
    createPasswordButton.prop('disabled', 'disabled');
}

function triggerTabUsername(){
    tabUsername.removeClass('disabled');
    tabUsername.click();
    tabVerification.addClass('disabled');
    tabPassword.addClass('disabled');
    prevButton.addClass('d-none');
    nextButton.addClass('disabled');
    nextButton.prop('disabled', 'disabled');
    currentPage = 1;
}

triggerTabUsername();

function triggerTabVerification(){
    tabVerification.removeClass('disabled');
    tabVerification.click();
    tabUsername.addClass('disabled');
    prevButton.removeClass('d-none');
    nextButton.addClass('disabled');
    nextButton.prop('disabled', 'disabled');
    requestOTP(usernameForgetPassword.val());
    currentPage = 2;
}

function triggerTabPassword(){
    tabPassword.removeClass('disabled');
    tabPassword.click();
    tabVerification.addClass('disabled');
    createPasswordButton.removeClass('d-none');
    prevButton.addClass('d-none');
    nextButton.addClass('d-none');
    // createPasswordButton.addClass('disabled');
    // createPasswordButton.prop('disabled');
    currentPage = 3;
}

nextButton.on('click', function(e){
    switch(currentPage){
        case 1:
            triggerTabVerification();
            break;
        case 2:
            triggerTabPassword();
            break;
    }
});

prevButton.on('click', function(e){
    triggerTabUsername();
    cancelCountdown();
    $('#countdown-expire-otp').html("");
    $("#re-request-otp-anchor").removeClass("disabled");
});

//Prevent License Number Input Other than Numeric Character
otpTextbox.keypress(function(e){
    if (e.which < 48 || e.which > 57){
        e.preventDefault();
    }
});

$('.modal').on('hidden.bs.modal', function(e)
{
    initialValue();
    triggerTabUsername();
    cancelCountdown();
    $('#countdown-expire-otp').html("");
    $("#re-request-otp-anchor").removeClass("disabled");
}) ;

