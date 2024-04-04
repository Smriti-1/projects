<?php
require('config.php');
session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header("location:login.php");
}
if (isset($_POST['add_to_cart'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

    $cart_number = " SELECT * FROM cart WHERE name= '$product_name' AND user_id='$user_id'";
    $check_cart_numbers = $db->query($cart_number);

    if ($check_cart_numbers->num_rows > 0) {
        $message[] = 'Product already added to cart!';
    } else {
        mysqli_query($db, "INSERT INTO cart(user_id,name, price, quatity, image) VALUES('$user_id','$product_name','$product_price','$product_quantity','$product_image')");

        $message[] = 'Product added to cart!';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include 'header.php'; ?>
    <section class="home">

        <div class="content">
            <h3>Hand Picked Book at your door.</h3>
            <p>“The more that you read, the more things you will know. The more that you learn, the more places you’ll go.”
                ―Dr. Seuss</p>

            <a href="about.php" class="white-btn">Discover more</a>
        </div>
    </section>

    <section class="products">
        <h1 class="title">Latest Products</h1>
        <div class="box-container">
            <?php
            $product = "SELECT * FROM products LIMIT 6";
            $select_products = $db->query($product);

            if ($select_products->num_rows > 0) {
                while ($fetch_products = mysqli_fetch_assoc($select_products)) {
            ?>
                    <form action="" method="post" class="box">
                        <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">

                        <div class="name"><?php echo $fetch_products['name']; ?></div>
                        <div class="price">$<?php echo $fetch_products['price']; ?>/-</div>

                        <input type="number" min="0" name="product_quantity" value="1" class="qty">
                        <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                        <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                        <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                        <input type="submit" value="Add to cart" name="add_to_cart" class="btn">
                    </form>

            <?php
                }
            } else {
                echo '<p class="empty">No products added yet!</p>';
            }
            ?>
        </div>
    </section>

    <div class="load-more" style="margin-top:2rem; text-align:center;">
        <a href="shop.php" class="option-btn">Load more</a>
    </div>

    <section class="about">
        <div class="flex">
            <div class="image">
                <img src="images/about-img.jpg" alt="">
            </div>
            <div class="content">
                <h3>About us</h3>
                <p>We work to connect readers with independent booksellers all over the world. We believe local bookstores are essential community hubs that foster culture, curiosity, and a love of reading, and we're committed to helping them survive and thrive. Our platform gives independent bookstores tools to compete online and financial support to help them maintain their presence in local communities.</p>
                <a href="about.php" class="btn">Read more</a>
            </div>
        </div>
    </section>

    <section class="home-contact">
        <div class="content">
            <h3>Have any queries?</h3>
            <p>If you have received damaged, defective, or incorrectly shipped merchandise please contact...</p>
            <a href="contact.php" class="white-btn">Contact us</a>
        </div>
    </section>
    <?php include 'footer.php'; ?>


    <script src="js/script.js"></script>
</body>

</html>