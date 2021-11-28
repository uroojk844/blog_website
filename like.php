<?php 
include_once('config.php');
$pid = $_GET['pid'];
$userid = $_SESSION['userid'];
$results = mysqli_query($conn,"
    select
    count(post_like.id) as likes
    from posts
    left join post_like
    on posts.id = post_like.post
    group by posts.id
");
$row = mysqli_fetch_array($results);
echo $row[0];
?>