<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme" content="crimson">
    <title>Notebook</title>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/w3.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
</head>

<body>

    <div id="ttl" class="w3-bar w3-card">
        <a href="index.php">
            <div class="w3-bar-item w3-padding-16" id="name"><i class="fa fa-book-open"></i> &nbsp;Notebook</div>
        </a>
        <div class="w3-bar-item w3-padding-16 w3-right w3-hide-medium w3-hide-large" onclick="show()">
            <i class=" fa fa-bars"></i>
        </div>
        <a href="logout.php">
            <div class="w3-bar-item w3-padding-16 w3-right" title="Sign out">
                <i class="fa fa-power-off"></i>
            </div>
        </a>
        <a href="profile.php">
        <div class="user w3-circle w3-medium w3-right">
            <?php
                include_once('config.php');
                if(isset($_SESSION['userid'])){        
                    $userid = $_SESSION['userid'];
                    $res = mysqli_query($conn, "select * from users where id='$userid'");
                    $row = mysqli_fetch_array($res);
                    $name = $row['name'];
                    $first = strtok($name," ");
                    while($first !== false){
                        echo $first[0];
                        $first = strtok(" "); 
                    }
                }else{
                    header('location: index.php');
                }
            ?>
        </div>
        </a>
    </div>

    <div class="w3-row-padding w3-margin-top w3-margin-bottom">

        <div class="w3-col l3 s12 w3 w3-padding w3-hide-medium w3-hide-small"></div>

        <div class="w3-col l5 m8 s12 w3-margin-top">

            <form id="postUpload" action="action.php" method="POST">

                <div class="w3-row-padding border w3-round">
                    <div class="w3-col s12 m8 w3-padding-16">
                        <div class="w3-large gradient w3-margin-bottom"><b>Title</b></div>
                        <input type="text" id="input" name="title" class="w3-input w3-round w3-border-purple w3-border"
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
                            class="w3-input w3-round w3-border w3-margin-bottom w3-border-purple" required></textarea>
                        <input type="submit" id="submit" class="w3-button w3-round w3-hover-black w3-ripple">
                    </div>

                </div>
                
                <input type="text" name="user" value="<?php echo $name;?>" class="w3-hide">

            </form>

            <div id="cat-cont"></div>
        </div>

        <div id="cat-cont1" class="w3-col l3 m4 s12 w3-margin-top w3-hide-small">
            <div class=" w3-round w3-padding border">
                <H4 class="gradient"><b>Categories</b></H4>
                <ul>
                    <li class="w3-ripple" onclick="filter('romantic')">Romantic</li>
                    <li class="w3-ripple" onclick="filter('nature')">Nature</li>
                    <li class="w3-ripple" onclick="filter('brokenHeart')">Broken heart</li>
                    <li class="w3-ripple" onclick="filter('depressive')">Depressive</li>
                    <li class="w3-ripple" onclick="filter('post')">All</li>
                </ul>
            </div>
        </div>

    </div>

    <script src="js/index.js"></script>
    <script src="js/jquery-3.4.1.js"></script>
    <script>
        $(document).ready(function () {

            $('#cat-cont').click(function (event) {
                $.ajax({
                    url: "result.php?id=" + event.target.parentElement.id,
                    method: "post",
                    data: $('form').serialize(),
                    dataType: "text",
                    success: function () {
                        $('#' + event.target.parentElement.id + ' .fa-heart').removeClass(
                            'far');
                        $('#' + event.target.parentElement.id + ' .fa-heart').addClass(
                            'fas');
                        $('#cat-cont').load('action.php');
                    }
                });
            });

            $('#submit').click(function (e) { 
                e.preventDefault();
                $.ajax({
                    url: "action.php",
                    method: "post",
                    data: $('form').serialize(),
                    dataType: "text",
                    success: function () {
                        $('#postUpload')[0].reset();
                        $('#cat-cont').load('action.php');
                    }
                });
            });

            $('#cat-cont').load('action.php');

        });
    </script>
</body>

</html>