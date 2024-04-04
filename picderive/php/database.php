<?php
$db = new mysqli("localhost","root","","picderive");
if($db -> connect_error)
{
    die("Database not connected");
}
?>