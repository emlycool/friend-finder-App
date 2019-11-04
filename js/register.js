$(document).ready(function () {
    $("#register-form").submit(function (e) {
        e.preventDefault();
        $("#register-btn").html('<span><i class="fa fa-spinner"></i> please wait</span>');
        // var formData = console.log($(this).serialize());
        var formData = $("#register-form").serialize();
        console.log(formData);
        $.ajax({
            type: "POST",
            url: "engine/reg_val.php",
            data: formData,
            dataType: 'json'

        })
            .done(function (data) {
                console.log(data);
                if (!data.success) {
                    console.log("success false");
                    $("#register-btn").html('Register Now');

                    $('#firstname-vd,#lastnmae-vd,#email-vd,#password-vd,#city-vd,#country-vd,#alert-div').html('');
                    if (data.errors.email) {
                        console.log("email error");
                        $('#email-vd').html(data.errors.email);
                    }
                    if (data.errors.firstname) {
                        $('#firstname-vd').html(data.errors.firstname);
                    }
                    if (data.errors.lastname) {

                        $('#lastname-vd').html(data.errors.lastname);
                    }
                    if (data.errors.password) {
                        $('#password-vd').html(data.errors.password);
                    }
                    if (data.errors.city) {
                        console.log("city required");
                        $('#city-vd').html(data.errors.city);
                    }
                    if (data.errors.country) {
                        console.log("country required");
                        $('#country-vd').html(data.errors.country);
                    }
                    if (data.errors.register) {
                        $("#alert-div").fadeIn(1000, function () {
                            $('#alert-div').html(data.errors.register);
                        });
                    }

                } else {
                    $("#register-btn").html('Register Now');
                    $('#email-vd, #password-vd, #firstname-vd, #lastname-vd, #city-vad, #country-vd,#alert-div').html('');

                    if (data.message) { //if call back is a sucsess

                        $('#email-vd, #password-vd, #firstname-vd, #lastname-vd, #city-vd, #country-vd,#alert-div').html('');
                        $("#register-btn").html('Signing Up ...');
                        swal({
                            text: "Registration Successful",
                            icon: "success",
                            timer: 1000,
                            button: false,
                        });
                        // setTimeout(function() {
                        //   location.assign("login.php");
                        // }, 1000);
                        $("#register-btn").html('Register Now');
                        $("#login_form").focus();
                    }
                }
            })
            .fail(function (data) {
                console.log(data);
            });


        return false;
    });
});