<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign in</title>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <?php
    include('link.php');
    ?>
    <link rel="stylesheet" href="css/index.css">
    <style>
        *{font-family:Poppins;}
        body{
            width:100%;
            height:100vh;
            background-image: linear-gradient(to right, #8a2be2b8, #ed143dcc);
        }
        input[type='text'],input[type='password']{
            outline:none;
        }
    </style>
</head>
<body>
<?php
session_start();
$msg="";
if(count($_POST)>0){
$user = $_POST['username'];
$pass = $_POST['pass'];
$conn = mysqli_connect('localhost', 'root', '', 'maryam');
$sql = "select * from users where username='$user' and pass='$pass'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
if(is_array($row)) {
$_SESSION['userid']=$row['id'];
}
else{
    $msg = "Invalid Username or Password!";
}
}
if(isset($_SESSION['userid'])){
    header("location: home.php");
}
?>
    <form id="form" action="" method="POST" class="w3-white w3-card-2 w3-round w3-padding w3-padding-16 w3-display-middle w3-col l4 m6 s11">
        <label class="w3-xlarge w3-block w3-center">
            <i class="fa fa-user-lock"></i> Login</label><br>
        <div>
            <label for="user" class="w3-large">Username</label> <br>
            <input type="text" name="username" placeholder="Username" class="w3-input w3-border w3-round" autofocus required>
        </div>
        <div>
            <label for="user" class="w3-large">Password</label> <br>
            <input type="password" name="pass" placeholder="Password" class="w3-input w3-border w3-round" required>
        </div>
        <div>
            <input type="submit" class="w3-button w3-ripple w3-hover-black w3-round w3-margin-top">
        </div>
        <div class="w3-center w3-text-red w3-margin-top">
            <?php
            if($msg!=''){
                echo $msg."<br>";
                $_SESSION['count'] += 1;
            }
            else{
                $_SESSION['count'] = 0;
            }

            if(isset($_SESSION['count']) && $_SESSION['count'] > 3){
                echo '<a href="register.php" style="text-decoration:none;">Forget Password!!</a>';
            }
            ?>
        </div>
        <a href="register.php" style="text-decoration:none;">
        <div class="w3-center w3-margin-top" style="cursor:pointer;">
        Create account <i class="fa fa-user-edit"></i> Sign up
        </div></a>
    </form>
</body>
</html>