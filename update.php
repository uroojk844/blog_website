<?php
include_once('config.php');
$userid = $_SESSION['userid'];
$uname = $_POST['uname'];
$sql = "UPDATE users SET name='$uname' WHERE id='$userid'";
mysqli_query($conn, $sql);
?>