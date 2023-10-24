<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){
  
   $email = mysqli_real_escape_string($conn, $_POST['usermail']);
   $pass = md5($_POST['password']);
   $select = " SELECT * FROM user_information WHERE  email = '$email' && password = '$pass'";
 
   $result = mysqli_query($conn, $select);
   
   $query = "SELECT name FROM user_information WHERE email = '$email'";
   $result_2 = mysqli_query($conn, $query);

   if(mysqli_num_rows($result) > 0){
      $_SESSION['usermail'] = $email;
      $_SESSION['name']= $query;
      header('location:welcome_page.php');
   }else{
      $error[] = 'incorrect password or email.';
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
</head>
<body>
    
<div class="form-container">

    <form action="" method="post" id="login-form"> 
        <h3 class="title">login now</h3>
        <?php
         if(isset($error)){
            foreach($error as $error){
               echo '<span class="error-msg">'.$error.'</span>';
            }
         }
      ?>
        <input type="email" name="usermail" id="usermail" placeholder="enter your email" class="box" >
        <input type="password" name="password" id="password" placeholder="enter your password" class="box" > 
        <input type="submit" value="login now" class="form-btn" name="submit" id="submit"> 
        <p>don't have an account? <a href="register_form.php">register now!</a></p>
    </form>

</div>


<script type="text/javascript">

var form = document.getElementById("login-form");



form.addEventListener("submit", function(event) {
    var email = document.getElementById("usermail");
    
    var password = document.getElementById("password");


    if (email.value == "" || password.value=="") {
        
        alert("Please enter an email & password");
        event.preventDefault();
    }

   
});
</script>

</body>
</html>
