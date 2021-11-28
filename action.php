<?php
include('config.php');
$userid = $_SESSION['userid'];
if(count($_POST)>0){
$ttl=$_POST['title'];
$poem=$_POST['poetry'];
$cat=$_POST['cat'];
$user=$_POST['user'];
$formatted = mysqli_real_escape_string($conn, $poem);
$date=date("d M Y");
$sql="INSERT into posts (title,post,date,cat,user,userid) values('$ttl','$formatted','$date','$cat','$user','$userid')";
if($conn->query($sql)){
    header("location:index.php");
}
else{
    echo"Cannot execute your request at the moment!! Try again later";
}
}

$results = mysqli_query($conn,"
    select
    posts.id,
    posts.title,
    posts.date,
    posts.cat,
    posts.post,
    posts.user,
    
    count(post_like.id) as likes
    
    from posts
    
    left join post_like
    on posts.id = post_like.post

    group by posts.id

    order by id desc

");

while($row=$results->fetch_object()){
        $items[] = $row;
}

if(mysqli_num_rows($results)<1){
    exit;
}

?>

<?php foreach($items as $item): ?>

    <?php
    $formatted = nl2br(htmlentities($item->post, ENT_QUOTES, 'UTF-8'));    
    ?>

    <div class="w3-round post <?php echo $item->cat; ?>" id="<?php echo $item->id; ?>">
        <div class="w3-padding w3-padding-24">
            <div><span class="w3-circle profileLogo w3-small">
                <?php
                    $len = 0;
                    $first = strtok($item->user," ");
                    while($first !== false && $len<2){
                        echo $first[0];
                        $first = strtok(" "); 
                        $len++;
                    }
                ?>
            </span><span class="gradient w3-large"><?php echo $item->title; ?> by <?php echo $item->user; ?></span></div>
            <p class="gradient"><?php echo $formatted; ?></p>
        </div>
        <div class="w3-bar w3-center">
            <div class="w3-bar-item w3-medium" id="<?php echo $item->id; ?>">
                <i class="<?php
                $check = mysqli_query($conn, "select post,user from post_like where post='$item->id' and user='$userid'");
                if(mysqli_num_rows($check)>0){
                    echo 'fas';
                }else{
                    echo 'far';
                } ?> fa-heart fa-2x"></i> <span class="like"><?php echo $item->likes; ?></span>
            </div>
            <div class="w3-medium date"><?php echo $item->date; ?></div>
            <div class="w3-padding w3-medium w3-right category"><?php echo $item->cat; ?></div>
        </div>
    </div>

    <?php endforeach; ?>