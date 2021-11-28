<?php
    include_once('config.php');
    $userid = $_SESSION['userid'];
    $pid = $_GET['pid'];
    $sql = "DELETE FROM posts WHERE id='$pid'";
    if(mysqli_query($conn,$sql)){
        echo "deleted";
    }
?>