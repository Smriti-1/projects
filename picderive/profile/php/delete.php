<?php
session_start();
$username = $_SESSION['username'];
$table_name = $_SESSION['table_name'];
require("../../php/database.php");
$path = $_POST['photo_path'];
$complete_path = "../".$path;
if(unlink("../".$path))
{
    $get_used_storage = "SELECT used_storage FROM users WHERE username = '$username'";
    $response = $db -> query($get_used_storage);
    $data = $response -> fetch_assoc();
    $used_storage = $data['used_storage'];

    $get_image_size = "SELECT image_size FROM $table_name WHERE image_path = '$complete_path '";
    $response_delete = $db -> query($get_image_size);
    $response_data = $response_delete -> fetch_assoc();
    $delete_file_size = $response_data['image_size'];
    $storage = $used_storage - $delete_file_size;
    $update_used_storage = "UPDATE users SET used_storage = '$storage' WHERE username = '$username'";
    if($db -> query($update_used_storage))
    {
        $delete_query = "DELETE FROM $table_name WHERE image_path = '$complete_path'";
        if($db -> query($delete_query))
        {
            echo "delete success";
        }
        else{
            echo "delte failed";
        }
    }
    else{
        echo "faled to update delete used_storage";
    }
   
}
else{
    echo "delete failed";
}
?>