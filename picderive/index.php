
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
    <link rel="stylesheet" href="style/index.css">
    <link rel="stylesheet" href="style/animate.css">
    <title>Picderive</title>
    <script src="js/ajax_randome_pass.js"></script>
    <script src="js/index.js"></script>
    <script src="js/ajax_user_check.js"></script>
    <script src="js/ajax_signup.js"></script>
    <script src="js/ajax_activate.js"></script>
    <script src="js/ajax_login.js"></script>
</head>
<body style="background:#FCD0CF" class="animated fadeIn slower">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 p-0">
                <img src="images/main_pic.jpg" alt="main_pic" class="shadow-lg w-100">
            </div>
            <div class="col-md-4 px-5 py-4">
                <h3 class="ml-2 mb-3">SIGN UP</h3>
                <form id="signup-form">
                    <input type="text" name="fullname" id="fullname" placeholder="ENTER YOUR NAME" required="required">
                    <div class="email-box">
                        <input type="email" name="email" placeholder="EMAIL" id="email" required="required">
                        <i class="fa fa-circle-o-notch fa-spin email-loader d-none"></i>
                    </div>
                    <div class="password-box">
                        <input type="password" name="password" id="password" required="required" placeholder="PASSWORD">
                        <i class="fa fa-eye show-icon" style="font-size: 18px;"></i>
                    </div>
                    <button class="btn float-left py-2">CLICK GENERATE TO IMPROVE SECURITY</button>
                    <button class="btn float-right generate-btn">GENERATE</button>
                    <button class="btn submit-btn m-3" disabled="disabled" type="submit">REGISTER NOW</button>
                    <div class="signup-notice">
                        
                    </div>
                </form>
                <div class="activator d-none px-2">
                    <span>Please check your email to get activation code</span>
                    <input type="text" name="code" id="code" placeholder="Activation code" class="my-3">
                    <button class="btn btn-dark activate-btn">Activate Now</button>
                </div>
            </div>
            <div class="col-md-4 px-5 py-4">
                <h3 class="ml-2 mb-3">Login</h3>
                <form id="login-form">
                    <div class="email-box">
                        <input type="email" name="email" id="login-email" placeholder="Username" required="required">
                    </div>
                    <div class="password-box">
                        <input type="password" name="password" id="login-password" placeholder="Password" required="required">
                        <i class="fa fa-eye login-show-icon"></i>
                    </div>
                    <button class="btn login-submit-btn float-right" type="submit">Login Now</button>
                    <br>
                    
                </form>
                <div class="login-notice">

                </div>
                <br>
                <div class="login-activator d-none px-2">
                    <span>Please check your email to get activation code</span>
                    <input type="text" name="code" id="login-code" placeholder="Activation code" class="my-3">
                    <button class="btn btn-dark login-activate-btn">Activate Now</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>