// const { post } = require("jquery")
$(document).ready(function () {
    $("#myform").validate({
        rules: {
            name: {
                required: true,
            },
            email: {
                required: true,
                email: true,
            },
            mobile: {
                required: true,
                maxlength: 10,
                minlength: 10,
            },
            upload:{
                required: true,
            },
            password: {
                required: true,
                minlength: 6,
            },
            cpassword: {
                required: true,
                equalTo: password,
            }
        },
        messages: {
            name: {
                required: "Your Name is required",
            },
            email: {
                required: "Email is required",
                email: "Please Enter valid Email",
            },
            mobile: {
                required: "Mobile number is required",
                maxlength: "Please Enter max 10 digits",
                minlength: "Please Enter min 10 digits",
            },
            upload:{
                required: "Please Upload Your valid address proof",
            },
            password: {
                required: "Password Required",
                minlength: "Password must contain atleast 6 characters",
            },
            cpassword: {
                required: "Confirm password is required",
                equalTo: "Confirm password must be same as Password",
            },
        },
        submitHandler:function(form) {
            $.ajax({
                url: "../ajax/insert.php",
                method: "post",
                data: new FormData(form),
                contentType:false,
                cache: false,
                processData: false,
                success: function (data) {
                    alert(data);
                }
            })
        }
    })
})