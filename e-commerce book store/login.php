<?php
require('config.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST") {

   $email = $_POST['email'];
   $pass = $_POST['password'];

   $check_user = "SELECT * FROM users WHERE email='$email' and password='$pass' ";
   $response = $db->query($check_user);

   if ($response->num_rows > 0) {
      $row = mysqli_fetch_assoc($response);

      if ($row['user_type'] == 'admin') {
         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['admin_email'] = $row['email'];
         $_SESSION['admin_id'] = $row['id'];
         header('location:admin_page.php');
      } else  if ($row['user_type'] == 'user') {
         $_SESSION['user_name'] = $row['name'];
         $_SESSION['user_email'] = $row['email'];
         $_SESSION['user_id'] = $row['id'];
         header('location:home.php');
      }
   } else {
      $message[] = "Incorrect Email or Password";
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php
   if (isset($message)) {
      foreach ($message as $message) {
         echo '
       <div class="message">
          <span>' . $message . '</span>
          <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
       </div>
       ';
      }
   }
   ?>
   <div class="form-container">

      <form action="" method="post">
         <h3>Login</h3>

         <input type="email" name="email" placeholder="Enter your email" required class="box">
         <input type="password" name="password" placeholder="Enter your password" required class="box">

         <input type="submit" name="submit" value="login now" class="btn">
         <p>Don"t have an account? <a href="register.php">Register now</a></p>
      </form>

   </div>
</body>

</html>