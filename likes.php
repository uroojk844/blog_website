<?php
    include_once('config.php');
    $id = $_POST['id'];
    $sql = "update posts set like=like+'1' where id='$id'";
    $result = mysqli_query($conn, $sql);
?>