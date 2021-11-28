<?php
include_once('config.php');
$user = $_POST['user'];
$sql1 = mysqli_query($conn, "SELECT username FROM users where username='$user'");
if(mysqli_num_rows($sql1)>0){
    echo "Username already exist!!";
}else{
    echo "";
}
?>