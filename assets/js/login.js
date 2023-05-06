$(document).ready(function () {
    $(function () {
        $("#myform").validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    required: true,
                    minlength: 6,
                },
            },
            messages: {
                email: {
                    required: "Email is required",
                    email: "Please Enter valid Email",
                },
                password: {
                    required: "Password Required",
                    minlength: "Password must contain atleast 6 characters",
                },
            },
            submitHandler: function (form) {
                $.ajax({
                    url: "../ajax/user_login.php",
                    method: "POST",
                    data: new FormData(form),
                    contentType: false,
                    cache: false,
                    processData: false,
                    datatype: 'json',
                    success: function (data) {
                        var dataResult = JSON.parse(data);
                        if (dataResult.statusCode == 200) {
                            window.location = "../views/dashboard.php";
                            // alert(dataResult.message);
                        } else {
                            alert(dataResult.message);
                            window.location = "../views/login.php";
                        }
                    }
                })
            },
        })
        $('body').on("click", "#save", function () {
            $("#save").html("Please wait");
            $("#save").attr("disabled", true);
            var email = $("#oemail").val();
            var save = "save";
            $.ajax({
                url: "../ajax/get_otp.php",
                method: "POST",
                data: {
                    email: email,
                    save: save,
                },
                success: function (data) {
                    var dataResult = JSON.parse(data);
                    if (dataResult.statusCode == 200) {
                        $("#save").html("Resend");
                        $("#save").attr("disabled", false)
                        alert(dataResult.message);
                        document.getElementById("verify").style.display = "inline";
                        document.getElementById("otp").style.display = "inline";
                    } else {
                        $("#save").html("Send OTP");
                        $("#save").attr("disabled", false);
                        alert(dataResult.message);
                    }
                }
            })
        })
    })
})