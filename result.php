<?php 
require_once('config.php');

if(isset($_GET['id'])){
    $id = (int)$_GET['id'];
    $userid = $_SESSION['userid'];

$conn->query("
    insert into post_like(user,post)
        select {$userid},{$id}
        where exists(
            select id
            from posts
            where id = {$id})
        and not exists(
            select id
            from post_like
            where user={$userid}
            and post = {$id})
        limit 1
");
 }
?>