<?php
require('config.php');
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header("location:login.php");
}


if (isset($_POST['add_product'])) {
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_img/' . $image;

    $select_prod_name = "SELECT name FROM products WHERE name= '$name'";
    $select_product_name = $db->query($select_prod_name);

    if ($select_product_name->num_rows == 1) {
        $message[] = 'Product name already added';
    } else {
        $add_prod_query = "INSERT INTO products(name, price ,image) VALUES('$name','$price','$image')";
        $add_product_query = $db->query($add_prod_query);

        if ($add_product_query) {

            if ($image_size > 200000) {
                $message[] = "Image size is too large";
            } else {
                move_uploaded_file($image_tmp_name, $image_folder);
                $message[] = "Product Added Successfully";
            }
        } else {
            $message[] = "Product could not be added";
        }
    }
}
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_image_query = mysqli_query($db, "SELECT image FROM products WHERE id='$delete_id'");

    $fetch_delete_image= mysqli_fetch_assoc($delete_image_query);
    unlink('uploaded_img/'.$fetch_delete_image['image']);
    mysqli_query($db, "DELETE FROM products WHERE id='$delete_id'");
    header('location:admin_products.php');
}

if(isset($_POST['update_product'])){

    $update_p_id= $_POST['update_p_id'];
    $update_name = $_POST['update_name'];
    $update_price= $_POST['update_price'];

    $update= "UPDATE products SET name= '$update_name', price='$update_price' WHERE id='$update_p_id'";
    $update_db = $db->query($update);

    $update_image = $_FILES['update_image']['name'];
    $update_image_tmp_name= $_FILES['update_image']['tmp_name'];
    $update_image_size= $_FILES['update_image']['size'];
    $update_folder = 'uploaded_img/'.$update_image;
    $update_old_image = $_POST['update_old_image'];

    if(!empty($update_image)){
        if($update_image_size> 200000){
            $message[] = "Image size is too large";
        } else {
            $update= "UPDATE products SET image= '$update_image',WHERE id='$update_p_id'";
    $update_db = $db->query($update);
            move_uploaded_file($update_image_tmp_name, $update_folder);

            unlink('uploaded_img/'.$update_old_image);
        }
    } 
    header('location:admin_products.php');
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="css/admin_style.css">
</head>

<body>
    <?php include 'admin_header.php' ?>
    <!-- product CRUD section -->

    <section class="add-products">
        <h1 class="title">Shop Products </h1>
        <form action="" method="post" enctype="multipart/form-data">

            <h3>Add product</h3>

            <input type="text" name="name" class="box" placeholder="Enter product name" required>
            <input type="number" min="0" name="price" class="box" placeholder="Enter product price" required>
            <input type="file" name="image" accept="image/jpg,image/jpeg, image/png" class="box" required>
            <input type="submit" value="Add product" name="add_product" class="btn">

        </form>
    </section>
    <!-- <products> -->
    <section class="show-products">

        <div class="box-container">

            <?php
            $select_prod = "SELECT * FROM products";
            $select_products = $db->query($select_prod);

            if ($select_products->num_rows > 0) {
                while ($fetch_products = mysqli_fetch_assoc($select_products)) {
            ?>
                    <div class="box">
                        <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
                        <div class="name"><?php echo $fetch_products['name']; ?></div>
                        <div class="price">$<?php echo $fetch_products['price']; ?>/-</div>
                        <a href="admin_products.php?update=<?php echo $fetch_products['id']; ?>" class="option-btn">Update</a>
                        <a href="admin_products.php?delete=<?php echo $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">Delete Product</a>
                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">No products added yet!</p>';
            }
            ?>
        </div>
    </section>

    <section class="edit-product-form">
        <?php
        if (isset($_GET['update'])) {
            $update_id = $_GET['update'];
            $update =  "SELECT * FROM products WHERE id='$update_id'";
            $update_query = $db->query($update);
            if ($update_query->num_rows == 1) 
            {
                while ($fetch_update = mysqli_fetch_assoc($update_query)) 
                {
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id'];?>">
            <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image'];?>">

            <img src="uploaded_img/<?php echo $fetch_update['image'];?>" alt="">
            <input type="text" name="update_name" value="<?php echo $fetch_update['name'];?>"class="box" required placeholder="Enter product name">

            <input type="number" name="update_price" value="<?php echo $fetch_update['price'];?>" min="0" class="box" required placeholder="Enter product price">

            <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png">

            <input type="submit" value="update" name="update_product" class="btn">
            <input type="reset" value="cancel" id="close-update" class="option-btn">
        </form>
        <?php
                }
            }
        }
         else {
            echo '<script>document.querySelector(".edit-product-form").style.display = "none";
            </script>';
        }
        ?>
    </section>
    <script src="js/admin.js"></script>
</body>

</html>