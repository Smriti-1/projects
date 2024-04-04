<?php
require('config.php');
session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About us</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include'header.php';?>
    <div class="heading">
        <h3>About us</h3>
        <p><a href="home.php">Home</a>/About us</p>
    </div>

    <section class="about">

        <div class="flex">

            <div class="image">

                <img src="images/about-img.jpg" alt="">
            </div>
            <div class="content">
                <h3>Why to choose us</h3>
                <p>We work to connect readers with independent booksellers all over the world. We believe local bookstores are essential community hubs that foster culture, curiosity, and a love of reading, and we're committed to helping them survive and thrive. Our platform gives independent bookstores tools to compete online and financial support to help them maintain their presence in local communities.</p>
                <a href="contact.php" class="btn">Read more</a>
            </div>
        </div>
    </section>

    <section class="reviews">
        <h1 class="title"> Reviews</h1>
        <div class="box-container">
            
            <div class="box">
                <img src="images/pic-1.png" alt="">
                <p>Hand Picked is a beautiful, sexy, fun, and heartwarming continuation of the Sunday Brothers series.
                I loved seeing characters from Pick Me. They add a lot of humor and depth to this book, and I like knowing that Knox and Gage are still happy.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>Johny deep</h3>
            </div>

            <div class="box">
                <img src="images/pic-2.png" alt="">
                <p>Hand Picked is a beautiful, sexy, fun, and heartwarming continuation of the Sunday Brothers series.
                I loved seeing characters from Pick Me. They add a lot of humor and depth to this book, and I like knowing that Knox and Gage are still happy.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h3>Amber phlip</h3>
            </div>

            <div class="box">
                <img src="images/pic-3.png" alt="">
                <p>Hand Picked is a beautiful, sexy, fun, and heartwarming continuation of the Sunday Brothers series.
                I loved seeing characters from Pick Me. They add a lot of humor and depth to this book, and I like knowing that Knox and Gage are still happy.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3> Harry </h3>
            </div>

            <div class="box">
                <img src="images/pic-4.png" alt="">
                <p>Hand Picked is a beautiful, sexy, fun, and heartwarming continuation of the Sunday Brothers series.
                I loved seeing characters from Pick Me. They add a lot of humor and depth to this book, and I like knowing that Knox and Gage are still happy.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>Sylvester</h3>
            </div>

            <div class="box">
                <img src="images/pic-5.png" alt="">
                <p>Hand Picked is a beautiful, sexy, fun, and heartwarming continuation of the Sunday Brothers series.
                I loved seeing characters from Pick Me. They add a lot of humor and depth to this book, and I like knowing that Knox and Gage are still happy.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>Avid reader</h3>
            </div>
        </div>
    </section>

    <section class="authors">
        <h1 class="title">Great Authors</h1>

        <div class="box-container">

            <div class="box">
                <img src="images/author-1.jpg" 
                alt="">
                <div class="share">
                <a href="#" class="fab fa-facebook-f"></a>
                 <a href="#" class="fab fa-twitter"></a>
                 <a href="#" class="fab fa-instagram"></a>
                <a href="#" class="fab fa-linkedin"></a>
                </div>
                <h3>Author 1</h3>
            </div>

            <div class="box">
                <img src="images/author-2.jpg" 
                alt="">
                <div class="share">
                <a href="#" class="fab fa-facebook-f"></a>
                 <a href="#" class="fab fa-twitter"></a>
                 <a href="#" class="fab fa-instagram"></a>
                <a href="#" class="fab fa-linkedin"></a>
                </div>
                <h3>Author 2</h3>
            </div>

            <div class="box">
                <img src="images/author-3.jpg" 
                alt="">
                <div class="share">
                <a href="#" class="fab fa-facebook-f"></a>
                 <a href="#" class="fab fa-twitter"></a>
                 <a href="#" class="fab fa-instagram"></a>
                <a href="#" class="fab fa-linkedin"></a>
                </div>
                <h3>Author 3</h3>
            </div>

            <div class="box">
                <img src="images/author-4.jpg" 
                alt="">
                <div class="share">
                <a href="#" class="fab fa-facebook-f"></a>
                 <a href="#" class="fab fa-twitter"></a>
                 <a href="#" class="fab fa-instagram"></a>
                <a href="#" class="fab fa-linkedin"></a>
                </div>
                <h3>Author 4</h3>
            </div>

            <div class="box">
                <img src="images/author-5.jpg" 
                alt="">
                <div class="share">
                <a href="#" class="fab fa-facebook-f"></a>
                 <a href="#" class="fab fa-twitter"></a>
                 <a href="#" class="fab fa-instagram"></a>
                <a href="#" class="fab fa-linkedin"></a>
                </div>
                <h3>Author 5</h3>
            </div>

            <div class="box">
                <img src="images/author-6.jpg" 
                alt="">
                <div class="share">
                <a href="#" class="fab fa-facebook-f"></a>
                 <a href="#" class="fab fa-twitter"></a>
                 <a href="#" class="fab fa-instagram"></a>
                <a href="#" class="fab fa-linkedin"></a>
                </div>
                <h3>Author 6</h3>
            </div>
        </div>
    </section>


    <?php include'footer.php';?>

    <script src="js/script.js"></script>
</body>
</html>