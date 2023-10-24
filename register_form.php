<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

   $your_name = mysqli_real_escape_string($conn, $_POST['your_name_reg']); 
   $your_email = mysqli_real_escape_string($conn, $_POST['your_mail_reg']);
   $your_pass = md5($_POST['your_pass_reg']);
   $your_cpass = md5($_POST['your_cpass_reg']);

   $select_name = " SELECT * FROM user_information WHERE name = '$your_name' ";
   $select_email = " SELECT * FROM user_information WHERE email = '$your_email' ";
   $result = mysqli_query($conn, $select_name);
   $result_2 = mysqli_query($conn, $select_email);

   if(mysqli_num_rows($result) > 0 && mysqli_num_rows($result_2) > 0){
      $error[] = 'User & Email already exist';
   }else if(mysqli_num_rows($result) > 0){$error[] = 'User already exist';}
   else if(mysqli_num_rows($result_2) > 0){$error[] = 'Email already exist';}
   else{
      if($pass != $cpass){
         $error[] = 'password not mathched!';
      }else{
         $insert = "INSERT INTO user_information(name, email, password) VALUES('$your_name','$your_email','$your_pass')"; 
         mysqli_query($conn, $insert);
         header('location:login_form.php');
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="css/style.css">
   
   <script>
      
      function validateForm() {
       
         var username = document.getElementsByName("your_name_reg")[0];
         var usermail = document.getElementsByName("your_mail_reg")[0];
         var password = document.getElementsByName("your_pass_reg")[0];
         var cpassword = document.getElementsByName("your_cpass_reg")[0];

         var succ =true;
      
         if (username.value == "" || usermail.value == ""||  password.value == "" || cpassword.value == "") {
           
            alert("Please fill all input fields");
            succ=false;
            return false;
         }
         if ( password.value != cpassword.value ) {
           
           alert("Passwords don't matching");
           succ=false;
            return false;
        }
      //   if(succ){
      //    alert("Register Done");
      //    return true;
      //   }

      }
   </script>
</head>
<body>
    
<div class="form-container">

   <form action="" method="post" onsubmit="return validateForm()"> 
      <h3 class="title">register now</h3>
      <?php
         if(isset($error)){
            foreach($error as $error){
               echo '<span class="error-msg">'.$error.'</span>';
            }
         }
      ?>
      <input type="text" name="your_name_reg" placeholder="enter your name" class="box"  > 
      <input type="email" name="your_mail_reg" placeholder="enter your email" class="box" >
      <input type="password" name="your_pass_reg" placeholder="enter your password" class="box" >
      <input type="password" name="your_cpass_reg" placeholder="confirm your password" class="box" >
      <input type="submit" value="register now" class="form-btn" name="submit">
      <p>already have an account? <a href="login_form.php">login now!</a></p>
   </form>

</div>

</body>
</html>