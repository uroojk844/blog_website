<?php
    include_once('config.php');
    $pid = $_GET['pid'];
    $sql = "select * from posts where id='$pid'";
    $res = mysqli_query($conn, $sql);
    if($res){
        while($row = mysqli_fetch_array($res)){
?>

<form id="postUpdate" action="action.php" method="POST">
            <div class="w3-row-padding border w3-round">
                <div class="w3-col s12 m8 w3-padding-16">
                    <div class="w3-large gradient w3-margin-bottom"><b>Title</b></div>
                    <input type="text" value="<?php echo $row['title']; ?>" id="input" name="title" class="w3-input w3-round w3-border-purple w3-border"
                        required>
                </div>
                <div class="w3-col s12 m4 w3-padding-16">
                    <div class="w3-large gradient w3-margin-bottom"><b>Category</b></div>
                    <select class="w3-padding w3-round w3-block w3-border-purple" name="cat">
                        <option value="romantic">Romantic</option>
                        <option value="nature">Nature</option>
                        <option value="brokenHeart">Broken Heart</option>
                        <option value="depressive">Depressive</option>
                    </select>
                </div>
                <div class="w3-padding-16 w3-col s12">
                    <div class="w3-large gradient w3-margin-bottom"><b>Post</b></div>
                    <textarea rows="1" name="poetry" id="textarea"
                        class="w3-input w3-round w3-border w3-margin-bottom w3-border-purple" required><?php echo $row['post']; ?></textarea>
                    <input type="submit" value="Update" id="update" class="w3-button w3-round w3-hover-black w3-ripple">
                </div>

            </div>

            <input type="text" name="user" value="<?php echo $name;?>" class="w3-hide">

        </form>
        <div class="w3-display-topright w3-transparent w3-button w3-hover-none"
            onclick="document.getElementById('updateForm').style.display='none'"><i class="fas fa-times"></i></div>

            <?php
        }
    }
?>