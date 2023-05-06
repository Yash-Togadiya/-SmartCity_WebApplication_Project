$(document).ready(function () {
    $(function () {
        $("#forgotpassword").validate({
            rules: {
                otp: {
                    required: true,
                    minlength: 6,
                },
            },
            messages: {
                otp: {
                    required: "OTP Required",
                    minlength: "OTP must contain 6 characters",
                },
            },
            submitHandler: function (form) {
                $.ajax({
                    url: "../ajax/verify_otp.php",
                    method: "POST",
                    data: new FormData(form),
                    contentType: false,
                    cache: false,
                    processData: false,
                    datatype: 'json',
                    success: function (data) {
                        var dataResult = JSON.parse(data);
                        if (dataResult.statusCode == 200) {
                            window.location = "../views/login.php";
                            alert(dataResult.message);
                        } else {
                            alert(dataResult.message);
                        }
                    }
                })
            },
        })
    })
})