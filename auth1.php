<?php
include_once('config.php');
$name = $_POST['name'];
$pass = $_POST['pass'];
$user = $_POST['user'];
$sql = "insert into users(username, pass,name) values('$user', '$pass', '$name')";
$res = mysqli_query($conn, $sql);
if($res){
    echo "Account created successfully!!";
}else{
    echo "Something went wrong!!";
}
?>