<?php
require('config.php');
session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header("location:login.php");
}

if (isset($_POST['update_cart'])) {

    $cart_id = $_POST['cart_id'];
    $cart_quantity = $_POST['cart_quantity'];
    mysqli_query($db, "UPDATE cart SET quatity= '$cart_quantity'WHERE id='$cart_id'");

    $message[] = "Cart quantity update!";
}
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($db, "DELETE FROM cart WHERE id='$delete_id'");
    header('location:cart.php');
}
if (isset($_GET['delete_all'])) {
    mysqli_query($db, "DELETE FROM cart WHERE user_id='$user_id'");
    header('location:cart.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="heading">
        <h3>Shopping Cart </h3>
        <p><a href="home.php">Home</a>/Cart</p>
    </div>

    <section class="shopping-cart">
        <h1 class="title">Product added</h1>

        <div class="box-container">
            <?php
            $grand_total = 0;
            $selectcart = "SELECT * FROM cart WHERE user_id = '$user_id'";

            $select_cart = $db->query($selectcart);
            if ($select_cart->num_rows > 0) {

                while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
            ?>
                    <div class="box">
                        <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="fas fa-times" onclick="return confirm('Delete this from cart');"></a>

                        <img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" alt="">
                        <div class="name"><?php echo $fetch_cart['name']; ?></div>
                        <div class="price">$<?php echo $fetch_cart['price']; ?>/-</div>

                        <form action="" method="post">
                            <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                            <input type="number" min=1 name="cart_quantity" value="<?php echo $fetch_cart['quatity']; ?>">
                            <input type="submit" name="update_cart" value="update" class="option-btn">
                        </form>
                        <div class="sub-total">
                            Sub total : <span>
                                $<?php
                                    echo $sub_total = ($fetch_cart['quatity'] * $fetch_cart['price']); ?>/-
                            </span>
                        </div>
                    </div>
            <?php
                    $grand_total += $sub_total;
                }
            } else {
                echo '<p class="empty">Your cart is empty</p>';
            }
            ?>
        </div>

        <div style="margin-top: 2 rem; text-align:center;">
            <a href="cart.php?delete_all" class="delete-btn" <?php echo ($grand_total > 1) ? '' : 'disabled'; ?> onclick="return confirm('Delete all from cart');"> Delete All</a>
        </div>

        <div class="cart-total">
            <p>Grand total: <span>$<?php echo $grand_total; ?>/-</span></p>
            <div class="flex">
                <a href="shop.php" class="option-btn">Continue shopping</a>
                <a href="checkout.php" class="btn <?php echo ($grand_total > 1) ? '' : 'disabled'; ?>"> Proceed to checkout</a>
            </div>
        </div>
    </section>
    <?php include 'footer.php'; ?>

    <script src="js/script.js"></script>
</body>

</html>