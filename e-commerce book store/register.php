<?php
require('config.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {

   $name = $_POST['name'];
   $email = $_POST['email'];
   $pass = $_POST['password'];
   $cpass = $_POST['cpassword'];
   $user_type = $_POST['user_type'];


   $check_user = "SELECT * FROM users WHERE email='$email' and password='$pass' ";
   $response = $db->query($check_user);

   if ($response->num_rows == 1) {

      $message[] = "User already exists!";
   } else {
      if ($pass != $cpass) {
         $message[] = 'Confirm password not matched';
      } else {
         $insert_data = "INSERT INTO users (name, email,password, user_type)VALUES('$name','$email','$pass','$user_type')";
         $response = $db->query($insert_data);
         if ($response) {
            $message[] = 'registered successfully!';
            header('location:login.php');
         } else {
            echo "error";
         }
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
   <title>Register</title>

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
         <h3>Register now</h3>
         <input type="text" name="name" placeholder="Enter your name" required class="box">
         <input type="email" name="email" placeholder="Enter your email" required class="box">
         <input type="password" name="password" placeholder="Enter your password" required class="box">
         <input type="password" name="cpassword" placeholder="Confirm your password" required class="box">
         <select name="user_type" class="box">
            <option value="user">user</option>
            <option value="admin">admin</option>
         </select>
         <input type="submit" name="submit" value="Register now" class="btn">
         <p>Already have an account? <a href="login.php">Login now</a></p>
      </form>

   </div>
</body>

</html>