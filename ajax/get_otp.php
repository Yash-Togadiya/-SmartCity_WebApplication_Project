<?php
    include('..\connection\config.php');
    include('..\smtp\PHPMailerAutoload.php');
    include('..\smtp\class.phpmailer.php');
    session_start();
    if(isset($_POST['save'])){
        extract($_POST);
        $otp=rand(10000,999999);
        $query="Update `users` set otp='$otp' where email='$email'";
        $update = mysqli_query($connection,$query);
        $sql="SELECT email from users where email='$email'";
        $data=mysqli_query($connection,$sql);
        if(mysqli_fetch_array($data)>0){
            $html=" <h1>Here is your OTP Passcode</h1>
                    <table>
                        <tr>
                            <th>Email :<?th>
                            <td>$email</td>
                        </tr>
                        <tr>
                            <th>OTP :</th>
                            <td>$otp</td>
                        </tr>
                    </table>
                    <h4>Verify OTP to Get your Password.</h4>
                    <h4>Please do not share OTP with any one!</h4>";
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

            $mail->Subject = 'Forgot Password OTP verification';
            $mail->Body    = $html;
            if($mail->send()){
                echo json_encode(array("statusCode" => 200, "message" => "Please Check your mail to get OTP!"));
                session_destroy();
                session_start();
                $_SESSION['otp']=$otp;
            }
        }else{
            echo json_encode(array("statusCode" => 201, "message" => "Email Not registered!"));
        }
    }
?>