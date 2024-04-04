<?php
require('config.php');
session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>
    <?php include'admin_header.php'?>

    <section class="dashboard">
        <h1 class="title">Dashboard</h1>

        <div class="box-container">

        <div class="box">
            <?php
            $total_pending = 0;
            $totalprice= "SELECT total_price FROM orders WHERE payment_status ='pending'";

            $select_pending = $db -> query($totalprice);

            if($select_pending ->num_rows == 1){

            while($fetch_pending = mysqli_fetch_assoc($select_pending))
            {
                $total_price= $fetch_pending['total_price'];
                $total_pending = $total_pending + $total_price;

            };
        }
            ?>
             <h3>
                <?php echo '$'.$total_pending.'/-';?>
            </h3>
             <p>Total pending</p>
              </div>  

              <div class="box">
            <?php
             $total_completed = 0;
            $selectcompleted ="SELECT total_price FROM `orders` WHERE payment_status = 'completed'";
            $select_completed= $db->query($selectcompleted);
            if(mysqli_num_rows($select_completed) > 0){
               while($fetch_completed = mysqli_fetch_assoc($select_completed)){
                  $total_price = $fetch_completed['total_price'];
                  $total_completed += $total_price;
               };
            };
            ?>
             <h3>
                <?php echo '$'.$total_completed.'/-';?>
            </h3>
             <p> Complete Payments</p>
              </div>  

            <div class="box">
                <?php
                $selectproducts= "SELECT * FROM products";
                
                $select_products = $db ->query($selectproducts);
                 
                $no_of_products = mysqli_num_rows($select_products);

                ?>
                <h3><?php echo $no_of_products; ?>
                </h3>
                <p>Order Placed</p>
              </div>

              <div class="box">
                <?php
                $selectproducts= "SELECT * FROM products";
                
                $select_products = $db ->query($selectproducts);
                 
                $no_of_products = mysqli_num_rows($select_products);

                ?>
                <h3><?php echo $no_of_products; ?>
                </h3>
                <p>Products Added</p>
              </div>

              <div class="box">
                <?php
                $selectusers= "SELECT * FROM users WHERE user_type ='user' ";
                
                $select_users = $db ->query($selectusers);
                 
                $no_of_users = mysqli_num_rows($select_users);

                ?>
                <h3><?php echo $no_of_users; ?>
                </h3>
                <p>Normal Users</p>
              </div>

              <div class="box">
                <?php
                $selectadmin= "SELECT * FROM users WHERE user_type ='admin' ";
                
                $select_admin = $db ->query($selectadmin);
                 
                $no_of_admin = mysqli_num_rows($select_admin);

                ?>
                <h3><?php echo $no_of_admin; ?>
                </h3>
                <p>Admins</p>
              </div>

              <div class="box">
                <?php
                $selectaccount= "SELECT * FROM users";
                
                $select_account = $db ->query($selectaccount);
                 
                $no_of_account= mysqli_num_rows($select_account);

                ?>
                <h3><?php echo $no_of_account; ?>
                </h3>
                <p>Total Users</p>
              </div>

              <div class="box">
                <?php
                $selectmessage= "SELECT * FROM messages ";
                
                $select_message = $db ->query($selectmessage);
                 
                $no_of_message= mysqli_num_rows($select_message);

                ?>
                <h3><?php echo $no_of_message ?>
                </h3>
                <p>New Messages</p>
              </div>

        </div>
    </section>

    <script src="js/admin.js"></script>
</body>
</html>