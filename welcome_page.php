<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['usermail'])){
   header('location:login_form.php');

}
   $email = $_SESSION['usermail'];
  $query = mysqli_query($conn," SELECT name FROM user_information WHERE email='$email'");
  while($result = mysqli_fetch_assoc($query)){
    $res_Uname = $result['name'];
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

<div class="container">
   <div class="content">
      <h3>Welcome!</h3>
      <p></p>
      <p>Your Name : <span><?php echo $res_Uname; ?></span></p>

      <p>Your email : <span><?php echo $_SESSION['usermail']; ?></span></p>
      <a href="logout.php" class="logout">logout</a>
   </div>
</div>

</body>
</html>