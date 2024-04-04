<?php
require("../../php/database.php");
session_start();
$username = $_SESSION['username'];
$get_id = "SELECT id FROM users WHERE username = '$username'";
$get_response = $db -> query($get_id);
$data = $get_response -> fetch_assoc();
$folder_name = "../gallery/user_".$data['id']."/";
$file = $_FILES['data'];
$user_path = $file['tmp_name'];
$file_name = strtolower($file['name']);
$file_size = round($file['size']/1024/1024,2);
$table_name = "user_".$data['id']; 
$complete_path = $folder_name.$file_name;


//chcek free space
$check_space = "SELECT storage,used_storage FROM users WHERE username = '$username'";
$response = $db -> query($check_space);
$data = $response -> fetch_assoc();
$total = $data['storage'];
$used = $data['used_storage'];
$free_space = $total - $used;
if($file_size<$free_space)
{
    if(file_exists($folder_name.$file_name))
    {
        echo "file already exist, plaese rename your file or upload other file";
    }
    else{
       if(move_uploaded_file($user_path,$folder_name.$file_name))
       {
           $store_data = "INSERT INTO $table_name(image_name,image_path,image_size)
            VALUES('$file_name','$complete_path','$file_size')";

            if($db -> query($store_data))
            {
                $select_storage = "SELECT used_storage FROM users WHERE username = '$username'";
                $response = $db -> query($select_storage);
                $data = $response -> fetch_assoc();
                $already_used_storage = $data['used_storage']+$file_size;

                $update_storage = "UPDATE users SET used_storage = '$already_used_storage' WHERE username = '$username'";
                if($db -> query($update_storage))
                {
                    echo "success";
                }
                else{
                    echo "failed to update used storage";
                }


            }
            else{
                echo "failed to store image in database";
            }
       }
       else{
           echo "upload failed";
       }
    }
}
else{
    echo "file size to large kindly purchase some memory space";
}
?>
