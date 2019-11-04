$('document').ready(function () {
    /* handling form validation */
    $("#login-form").validate({
        rules: {
            password: {
                required: true,
            },
            user_email: {
                required: true,
                email: true
            },
        },
        messages: {
            password: {
                required: "please enter your password"
            },
            user_email: "please enter your email address",
        },
        submitHandler: submitForm
    });
    /* Handling login functionality */
    function submitForm() {
        var data = $("#login-form").serialize();
        $.ajax({
            type: 'POST',
            url: 'engine/login_check.php',
            data: data,
            beforeSend: function () {
                $("#error").fadeOut();
                $("#login_button").html('<i class="fa fa-spinner fa-spin"></i> &nbsp; Please wait');
            },
            success: function (response) {
                if (response === "ok") {
                    $("#login_button").html('Signing In ...');
                    // setTimeout(swal({
                    //   title: "Friend finder",
                    //   text: "You have successfully login",
                    //   icon: "success",
                    // }), 1000);
                    setTimeout(function () {
                        location.assign("pages/newsfeed.php");
                    }, 1000);
                } else {
                    $("#error").fadeIn(1000, function () {
                        $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; ' + response + ' !</div>');
                        $("#login_button").html('Login Now');
                    });
                }
            }
        });
        return false;
    }
});