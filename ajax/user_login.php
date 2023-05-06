<?php
   include('..\connection\config.php');
   if(isset($_POST['submit'])){
      extract($_POST);
      $sql="SELECT * from users where email='$email'";
      $result=mysqli_query($connection,$sql);
      $row = mysqli_fetch_array($result);
      if ($row>0){
         if(base64_decode($row['password'])==$password){
            echo json_encode(array("statusCode" => 200, "message" => "You have logged in!"));
         }else{
            echo json_encode(array("statusCode" => 201, "message" => "Password Not matched."));
         }
      }else{
         echo json_encode(array("statusCode" => 201, "message" => "Enter Valid Email."));
      }
   }
?>