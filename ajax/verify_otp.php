<?php
    include('..\connection\config.php');
    include('..\smtp\PHPMailerAutoload.php');
    include('..\smtp\class.phpmailer.php');
    session_start();
    if(isset($_POST['verify'])){
        extract($_POST);
        $sql="SELECT * from users where email='$email' and otp='$otp";
        $row=mysqli_query($connection,$sql);
        $data=mysqli_fetch_array($row);
        $password =  base64_decode($data['password']);
        if($data>0){
            $html=" <h1>Here is your Account Password</h1>
                    <table>
                        <tr>
                            <th>Email :<?th>
                            <td>$email</td>
                        </tr>
                        <tr>
                            <th>Password :</th>
                            <td>$password</td>
                        </tr>
                    </table>
                    <h4>Now you can login to your account using this password.</h4>";
            $mail = new PHPMailer(true);

            //$mail->SMTPDebug = 3;                               // Enable verbose debug output

            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = "smartcityspy@gmail.com";                 // SMTP username
            $mail->Password = "shp@y@273735";                       // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            $mail->setFrom("smartcityspy@gmail.com");
            $mail->addAddress($_POST['email']);    // Add a recip
            $mail->isHTML(true);                                  // Set email format to HTML

            $mail->Subject = 'Recover your Forgot Password';
            $mail->Body    = $html;
            if($mail->send()){
                echo json_encode(array("statusCode" => 200, "message" => "Password is sent to your Email Id successfully."));
                session_destroy();
            }else {
                echo json_encode(array("statusCode" => 201, "message" => "Something went wrong!"));
            }
        }else{
            echo json_encode(array("statusCode" => 201, "message" => "Enter valid OTP sent to your Email ID."));
        }
    }
?>