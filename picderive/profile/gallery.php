<?php
session_start();
$username = $_SESSION['username'];
if(empty($username))
{
    header("Location:../index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
     integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Francois+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link
    rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <title>Profile</title>
    <script src="js/profile.js"></script>
    <script src="js/edit_photo.js"></script>
    <style>
        span:focus{
            outline:2px dashed red;
            padding : 2px;
            box-shadow : 0px 0px 5px grey;
        }
    </style>
</head>
<body style="background:#FCD0CF">
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <a href="#" class="navbar-brand">
            <?php
                require("../php/database.php");
                $username = $_SESSION['username'];
                $get_name = "SELECT full_name FROM users WHERE username = '$username'";
                $response = $db -> query($get_name);
                $data = $response -> fetch_assoc();
                echo "Mr ".$data['full_name'];
            ?>
        </a>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a href="php/logout.php" class="nav-ink">
                    <i class="fa fa-sign-out" style="font-size: 18px;">Logout</i>
                </a>
            </li>
        </ul>
    </nav>
    <br>
    <div class="container mt-5">
        <div class="row">
        <?php
    $table_name = $_SESSION['table_name'];
    $get_image_path = "SELECT * FROM $table_name";
    $respone = $db -> query($get_image_path);
    while($data = $respone -> fetch_assoc())
    {
    $image_name = pathinfo($data['image_name']);
    $img_name = $image_name['filename'];
    $path = str_replace("../","",$data['image_path']);
    echo "<div class='col-md-3 px-5 pb-5'>
    <div class='card shadow-lg'>
    <div class='card-body d-flex justify-content-center align-items-center'>
    <img src=".$path." width='100' height='100' class='rounded-circle pic'>
    </div>
    <div class='card-footer d-flex  justify-content-around align-items-center'>
    <span>".$img_name."</span>
    <i class='fa fa-save save-icon d-none' data-location='".$path."'></i>
    <i class='fa fa-spinner fa-spin d-none loader' data-location='".$path."'></i>
    <i class='fa fa-edit edit-icon' data-location='".$path."'></i>
    <i class='fa fa-download download-icon' data-location='".$path."' file-name='".$img_name."'></i>
    <i class='fa fa-trash delete-icon' data-location='".$path."'></i>
    </div>
    </div>
    </div>";
    }
?>
</div>
</div>
    <div class="modal my-5 animate__animated animate__bounceIn" id="view-modal">
        <div class="modal-dialog">
            <i class="fa fa-times-circle float-right text-white" data-dismiss="modal"></i>
           <div class="modal-content">
            <div class="modal-body">
                welcome
            </div>
           </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $(".pic").each(function(){
            $(this).click(function(){
                var image = document.createElement("IMG");
                image.src = $(this).attr("src");
                image.style.width = "100%";
                $(".modal-body").html(image);
                $("#view-modal").modal();
            });
        });
        });
    </script>
</body>
</html>