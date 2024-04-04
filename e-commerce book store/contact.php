<?php
require('config.php');
session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header("location:login.php");
}
if (isset($_POST['send'])) {
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $number = $_POST['number'];
    $msg = mysqli_real_escape_string($db, $_POST['message']);

    $select_msg = "SELECT * FROM messages WHERE name= '$name' AND email= '$email' AND number= '$number'AND message= '$msg'";

    $select_message = $db->query($select_msg);
    if ($select_message->num_rows != 0) {
        $message[] = "Message sent already!";
    } else {
        mysqli_query($db, "INSERT INTO messages(user_id, name, email, number, message) VALUES ('$user_id', '$name', '$email', '$number', '$msg')");

        $message[] = "Message sent successfully!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="heading">
        <h3>Contact us</h3>
        <p><a href="home.php">Home</a>/Contact us</p>
    </div>

    <section class="contact">

        <form action="" method="post">
            <h3>Say Something!</h3>
            <input type="text" name="name" required placeholder="Your Name" class="box">
            <input type="email" name="email" required placeholder="Your Email" class="box">
            <input type="number" name="number" required placeholder="Your Number" class="box">
            <textarea name="message" class="box" cols="30" rows="10" placeholder="Enter Your Message"></textarea>
            <input type="submit" value="send message" name="send" class="btn">
        </form>
    </section>
    <?php include 'footer.php'; ?>

    <script src="js/script.js"></script>
</body>

</html>