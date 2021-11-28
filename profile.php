<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/w3.css">
    <link rel="stylesheet" href="css/profile.css">
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
                    $first = strtok($row['name']," ");
                    while($first !== false){
                        echo $first[0];
                        $first = strtok(" "); 
                    }
                }
                else{
                    header("location: index.php");
                }
                ?>
            </div>
        </a>
    </div>

    <div class="w3-row-padding">
        <div id="profileContainer" class="w3-round w3-col m12">

            <div class="gradient w3-xlarge w3-center w3-padding w3-border-bottom w3-wide"> <i
                    class="fas fa-user-alt"></i>
                User profile
            </div>

            <div class="w3-row-padding w3-mobile w3-margin-top">
                <div class="w3-col l4 m2 w3-padding w3-hide-small"></div>
                <div class="w3-padding w3-circle w3-col l3 m4 w3-margin" id="profilePic">
                    <?php
                        $res = mysqli_query($conn, "select * from users where id='$userid'");
                        $row = mysqli_fetch_array($res);
                        $name = $row['name'];
                        $username = $row['username'];
                        $first = strtok($row['name']," ");
                        while($first !== false){
                            echo $first[0];
                            $first = strtok(" "); 
                        }
                    ?>
                </div>

                <form method="POST">
                    <div class="w3-padding w3-col l4 m4 w3-padding w3-margin-left"
                        style="position:relative;height:200px">
                        <div class="w3-large w3-margin-bottom w3-margin-top gradient"
                            style="text-transform:capitalize;">
                            Name - <span id="uname"><?php echo $name; ?></span>
                            <input type="text" id="input1" name="uname" class="w3-hide">
                        </div>
                        <div class="w3-large w3-margin-bottom gradient">
                            Username - <?php echo $row['username']; ?>
                        </div>
                        <div class="w3-block">
                            <input type="button" id="profileEdit" class="w3-button w3-hover-black w3-ripple w3-wide"
                                value="Edit">
                            <input type="submit" id="profileUpdate" class="w3-button w3-hover-black w3-ripple w3-wide"
                                value="Update">
                        </div>
                    </div>
                    </from>

            </div>

        </div>
    </div>

    <h3 class="w3-margin-left"><b>Posts</b></h3>
    <div id="userPost" class="w3-row-padding w3-margin-bottom"></div>

    <div class="w3-white" id="updateForm" style="display:none"></div>

    <script src="js/jquery-3.4.1.js"></script>
    <script>
        var edit = document.getElementById('profileEdit');
        var update = document.getElementById('profileUpdate');

        edit.addEventListener('click', function () {
            document.getElementById('uname').contentEditable = "true";
            document.getElementById('uname').focus();
            edit.style.display = "none";
            update.style.display = "inline";
        });

        $(document).ready(function () {

            $('#profileUpdate').click(function (e) {
                e.preventDefault();
                $('#input1').val($('#uname').html());

                $.ajax({
                    url: "update.php",
                    data: $('form').serialize(),
                    dataType: "text",
                    method: "post",
                    success: function (response) {
                        document.getElementById('uname').contentEditable = "false";
                        edit.style.display = "inline";
                        update.style.display = "none";
                    }
                });
            })

            $('#userPost').click(function (event) {
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
                        $('#userPost').load('userpost.php');
                    }
                });
            });

            $('#userPost').load('userpost.php');

        });

        function deletePost(e) {
            $.ajax({
                url: "delete.php?pid=" + e,
                data: $('form').serialize(),
                dataType: "text",
                method: "post",
                success: function (response) {
                    $('#userPost').load('userpost.php');
                }
            });
        }

        function editPost(e) {
            let post = document.getElementById('updateForm');
            post.style.display = "block";

                $.ajax({
                    url: "data.php?pid="+e,
                    data: $('form').serialize(),
                    dataType: "text",
                    method: "post",
                    success: function (response) {
                        $('#updateForm').load('data.php');
                    }
                });

                $('#update').click(function(){
                    $.ajax({
                    url: "updatePost.php?pid="+e,
                    data: $('form').serialize(),
                    dataType: "text",
                    method: "post",
                    success: function (response) {
                        post.style.display = "none";
                        $('#userPost').load('userpost.php');
                    }
                });
            });
        }

        function showMenu(e) {
            let x = document.getElementById(e + "postMenu");
            x.classList.toggle('w3-hide');
        }
    </script>

</body>

</html>