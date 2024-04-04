<?php
require('config.php');
session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header("location:login.php");
}
if (isset($_POST['order_btn'])) {
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $number = $_POST['number'];
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $method = mysqli_real_escape_string($db, $_POST['method']);
    $address = mysqli_real_escape_string($db, 'flat no.' . $_POST['flat'] . ',' . $_POST['street'] . ',' . $_POST['city'] . ',' . $_POST['state'] . ',' . $_POST['country'] . '-' . $_POST['pin_code']);

    $placed_on = date('d-M-Y');
    $cart_total = 0;
    $cart_products[] = '';
    $cart = "SELECT * FROM cart WHERE user_id='$user_id'";
    $cart_query = $db->query($cart);

    if ($cart_query->num_rows > 0) {

        while ($cart_item =  mysqli_fetch_assoc($cart_query)) {
            $cart_products[] = $cart_item['name'] . ' (' . $cart_item['quatity'] . ') ';
            $sub_total = $cart_item['price'] * $cart_item['quatity'];

            $cart_total += $sub_total;
        }
    }
    $total_products = implode(', ', $cart_products);
    $orderquery = "SELECT * FROM orders WHERE name ='$name' AND number='$number' AND email='$email' AND method='$method' AND address= '$address' AND total_products='$total_products' AND total_price = '$cart_total'";

    $order_query = $db->query($orderquery);
    if ($cart_total == 0) {
        $message[] = 'Your cart is empty';
    } else {
        if ($order_query->num_rows > 0) {
            $message[] = 'Order already placed';
        } else {
            mysqli_query($db, "INSERT INTO orders (user_id,name, number, email,method, address,total_products,total_price, placed_on) VALUES ('$user_id','$name','$number','$email','$method','$address','$total_products','$cart_total','$placed_on')");

            $message[] = 'Order placed succesfully';

            mysqli_query($db, "DELETE FROM cart WHERE user_id ='$user_id'");
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
    <title>Checkout</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="heading">
        <h3>Checkout </h3>
        <p><a href="home.php">Home</a>/Checkout</p>
    </div>
    <section class="display-order">
        <?php
        $grand_total = 0;
        $selectcart = "SELECT * FROM cart WHERE user_id = '$user_id' ";
        $select_cart = $db->query($selectcart);

        if ($select_cart->num_rows > 0) {
            while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                $total_price = ($fetch_cart['price'] * $fetch_cart['quatity']);

                $grand_total += $total_price;
        ?>
                <p> <?php echo $fetch_cart['name']; ?>
                    <span>
                        (<?php
                            echo '$' . $fetch_cart['price'] . '/-' . 'x' . $fetch_cart['quatity'];
                            ?>)
                    </span>
                </p>
        <?php
            }
        } else {
            echo '<p class="empty">Your cart is empty</p>';
        }
        ?>
        <div class="grand-total">
            Grand Total : $<span><?php echo $grand_total; ?>/-</span>
        </div>
    </section>
    <section class="checkout">

        <form action="" method="post">
            <h3>Place order</h3>
            <div class="flex">
                <div class="inputBox">
                    <span>Your Name : </span>
                    <input type="text" name="name" required placeholder="Enter your name">
                </div>
                <div class="inputBox">
                    <span>Your Number : </span>
                    <input type="number" name="number" required placeholder="Enter your number">
                </div>

                <div class="inputBox">
                    <span>Your Email : </span>
                    <input type="email" name="email" required placeholder="Enter your email">
                </div>

                <div class="inputBox">
                    <span>Payment Method : </span>
                    <select name="method">
                        <option value="cash on delivery"> Cash on delivery</option>
                        <option value="credit card"> Credit Card </option>
                        <option value="paypal">Paypal</option>
                        <option value="paytm">Paytm</option>
                    </select>
                </div>

                <div class="inputBox">
                    <span>Address line 01 : </span>
                    <input type="number" min="0" name="flat" required placeholder="e.g. Flat no.">
                </div>
                <div class="inputBox">
                    <span>Address line 02 : </span>
                    <input type="text" name="street" required placeholder="e.g. street name">
                </div>
                <div class="inputBox">
                    <span>City : </span>
                    <input type="text" name="city" required placeholder="e.g. Lucknow">
                </div>

                <div class="inputBox">
                    <span>State : </span>
                    <input type="text" name="state" required placeholder="e.g. Uttar Pradesh">
                </div>
                <div class="inputBox">
                    <span>Country : </span>
                    <input type="text" name="country" required placeholder="e.g. India">
                </div>
                <div class="inputBox">
                    <span>Pincode : </span>
                    <input type="text" min="0" name="pin_code" required placeholder="e.g. 123456">
                </div>
            </div>
            <input type="submit" value="Order now" class="btn" name="order_btn">
        </form>
    </section>






    <?php include 'footer.php'; ?>

    <script src="js/script.js"></script>
</body>

</html>