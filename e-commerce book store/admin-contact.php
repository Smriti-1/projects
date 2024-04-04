<?php
require('config.php');
session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header("location:login.php");
}
if(isset($_GET['delete'])){
    $delete_id= $_GET['delete'];
    mysqli_query($db, "DELETE FROM messages WHERE id= '$delete_id'");
    header('location:admin_contact.php');
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

    <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>
    <?php include'admin_header.php'?>

    <section class="messages">

    <h1 class="title">Messages</h1>
        <div class="box-container">
        <?php
            $select_message = mysqli_query($db,"SELECT * FROM messages");

            if(mysqli_num_rows($select_message)>0){
                while($fetch_message = mysqli_fetch_assoc($select_message)){
     ?>
     <div class="box">
        <p> name : <span><?php echo $fetch_message['name'];?></span></p>
        <p> number : <span><?php echo $fetch_message['number'];?></span></p>
        <p> email : <span><?php echo $fetch_message['email'];?></span></p>
        <p> message : <span><?php echo $fetch_message['message'];?></span></p>
        <a href="admin_contact.php?delete=<?php echo $fetch_message['id'];?>"onclick="return confirm('Delete this message?');" class="delete-btn">Delete message</a>
     </div>
<?php
}
}else {
    echo '<p class="empty">You have no messages yet!</p>';
}

?>
        </div>
    </section>
    <script src="js/admin.js"></script>
</body>
</html>