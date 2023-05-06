<?php
    include('..\connection\config.php');
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = test_input($_POST["name"]);
        $email = test_input($_POST["email"]);
        $mobile = test_input($_POST["mobile"]);
        $password = test_input($_POST["password"]);
    } 
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    if(isset($_POST["submit"])) {
        $password =  base64_encode($_POST['password']);
        $uploadOk = 1;
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["upload"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["upload"]["tmp_name"]); 
        if(file_exists($target_file)) {
            echo "Sorry, Account already exists with this ID. ";
            $uploadOk = 0;
        }elseif(move_uploaded_file( $_FILES['upload']['tmp_name'], $target_file )) {
            $uploadOk = 1;
        }else {
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            echo "Your ID was not uploaded.";
            die;
        }else{
            $query = mysqli_query($connection,"INSERT INTO `users` (`Name`, `Email`, `Mobile`, `Password`, `document`) VALUES ('$name','$email','$mobile','$password','$target_file')");
        } 
        if($query){
            echo"Account Registered successfully";
            // header("Location:login.php");
        }else{
            echo"Something went wrong";
        }
    }
?>