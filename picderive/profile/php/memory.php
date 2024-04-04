<?php
    session_start();
    $username = $_SESSION['username'];
    require("../../php/database.php");
    $get_status = "SELECT storage,used_storage FROM users WHERE username = '$username'";
    $response = $db -> query($get_status);
    $data = $response -> fetch_assoc();
    $total = $data['storage'];
    $used = $data['used_storage'];
    $percentage = round(($used*100)/$total,2);
    $free_space = $total-$used;
    $response = [$used."MB/".$total."MB",$free_space,$percentage];
    echo json_encode($response);
    $color = "";
    if($percentage>80)
    {
        $color = "bg-danger";
    }
    else{
        $color = "bg-primary";
    }
?>