createPasswordButton.on("click", function (e) {
    if (passwordForgetPassword.val().length >= 8) {
        if (
            confirmPasswordForgetPassword.val() === passwordForgetPassword.val()
        ) {
            createPassword();

            passwordForgetPassword
                .removeClass("is-invalid")
                .addClass("is-valid");
            confirmPasswordForgetPassword
                .removeClass("is-invalid")
                .addClass("is-valid");
        } else {
            confirmPasswordForgetPassword.addClass("is-invalid");
            $("#password-error-message").html("Kata sandi tidak sesuai");
        }
    } else if (
        passwordForgetPassword.val() === "" ||
        confirmPasswordForgetPassword.val() === ""
    ) {
        $("#password-error-message").html("Please enter the password");
    } else {
        passwordForgetPassword.addClass("is-invalid");
        $("#password-error-message").html("Password is less than 8 characters");
    }
});
passwordForgetPassword.on("change", function (e) {
    if (confirmPasswordForgetPassword.val() !== "") {
        if (
            confirmPasswordForgetPassword.val() !== passwordForgetPassword.val()
        ) {
            setTimeout(function () {
                $(this).addClass("is-invalid");
                $("#password-error-message").html("Kata sandi tidak sesuai");
            }, 1250);
        } else if ($(this).val() === "") {
            $(this).addClass("is-invalid");
            $("#password-error-message").html("Please enter the password");
        } else if ($(this).val().length < 8) {
            $(this).addClass("is-invalid");
            $("#password-error-message").html(
                "Password is less than 8 characters"
            );
        } else {
            setTimeout(function () {
                $(this).addClass("is-valid");
                $("#password-error-message").html("");
            }, 1250);
        }
    }
});

function createPassword() {
    $("#loader").removeClass("hide");
    passwordForgetPassword.prop("disabled", "disabled");
    confirmPasswordForgetPassword.prop("disabled", "disabled");

    $.ajax({
        type: "POST",
        data: {
            token: SAVED_TOKEN,
            password: passwordForgetPassword.val(),
            credential: usernameForgetPassword.val(),
        },
        url: "/auth/create-password",
        success: function (e) {
            window.location.replace("/profile");
            $("#loader").addClass("hide");
        },
        error: function (xhr, status, error) {
            $("#loader").addClass("hide");
            usernameForgetPassword.removeClass("disabled");

            if (xhr.status === 404) {
                customSwal(
                    xhr.status + " - " + xhr.statusText,
                    "Requested URL is not found!"
                );
            } else {
                customSwal(
                    xhr.status + " - " + xhr.statusText,
                    "Koneksi ke Aplikasi Eror! Hubungi Bagian Admin!"
                );
            }
        },
    });
}
