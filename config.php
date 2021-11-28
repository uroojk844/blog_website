<?php
$conn=mysqli_connect("localhost","root","","maryam");
if(!$conn){
    echo "error in connection";
}
session_start();
?>