<?php

require("database.php");
$fullname = base64_decode($_POST['fullname']);
$username = base64_decode($_POST['username']);
$password = base64_decode($_POST['password']);

$i;
$code = [];
for($i=0;$i<6;$i++)
{
    $code [] = $indexing_number = rand(0,9);
}
$activation_code = implode($code);

$insert_data = "INSERT INTO users(full_name,username,password,activation_code)VALUES('$fullname','$username','$password','$activation_code')";
if($db -> query($insert_data))
{
    $check_email = mail($username,"Picdereive activation code","Thanks for choosing our product, Your activation code is : ".$activation_code);
    if($check_email == true)
    {
        echo "sending success";
    }
    else{
        echo "sending failed";
    }
}
else{
    echo "sign up failed";
}

?>