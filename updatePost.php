<?php
include_once('config.php');
$pid = $_GET['pid'];
$title = $_POST['title'];
$cat = $_POST['cat'];
$poetry = $_POST['poetry'];
$sql = "UPDATE posts SET title='$title',cat='$cat',post='$poetry' WHERE id='$pid'";
mysqli_query($conn, $sql);
?>