<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign up</title>
    <?php
    include('link.php');
    ?>
    <link rel="stylesheet" href="CSS/register.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="CSS/index.css">
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
    <form action="auth1.php" id="form" method="POST" class="w3-white w3-card-2 w3-round w3-padding w3-padding-16 w3-display-middle w3-col s11 m6 l5">
        <label class="w3-xlarge w3-block w3-center">
            <i class="fa fa-user-edit"></i> Sign up</label>
        <div>
            <label for="user" class="w3-large">Name</label> <br>
            <input type="text" name="name" placeholder="Your full name" class="w3-input w3-border w3-round" autofocus required>
        </div>
        <div>
            <label for="user" class="w3-large">Username</label> <br>
            <input id="username" type="text" name="user" placeholder="Username" class="w3-input w3-border w3-round" required>
        </div>
        <div>
            <label for="pass" class="w3-large">Password</label> <br>
            <input type="password" id="pass" oninput="check()" name="pass" placeholder="Password" class="w3-input w3-border w3-round" required>
        </div>
        <div>
            <label for="cpass" class="w3-large">Confirm password</label> <br>
            <input type="password" id="cpass" oninput="check()" name="cpass" placeholder="Confirm password" class="w3-input w3-border w3-round" required>
        </div>
        <div>
            <input type="submit" id="submit" class="w3-margin-bottom w3-button w3-hover-black w3-ripple w3-round w3-margin-top" disabled>
        </div>
        <div class="w3-center w3-text-red w3-margin-bottom" id="status"></div>
        <a href="index.php" style="text-decoration:none;">
        <div id="already" class="w3-center" style="cursor:pointer;">
        Already have an account? <i class="fa fa-user-lock"></i> Sign in
        </div></a>
    </form>

    <script src="js/jquery-3.4.1.js"></script>
    <script>
        function check(){
            let pass = document.getElementById('pass');
            let cpass = document.getElementById('cpass');
            if(pass.value == cpass.value){
                document.getElementById('submit').disabled = false;
                pass.classList.remove("w3-border-red");
                cpass.classList.remove("w3-border-red");
                pass.classList.add("w3-border-green");
                cpass.classList.add("w3-border-green");
            }else{
                document.getElementById('submit').disabled = true;
                pass.classList.add("w3-border-red");
                cpass.classList.add("w3-border-red");
                pass.classList.remove("w3-border-green");
                cpass.classList.remove("w3-border-green");
            }
        }

        $(document).ready(function(){      
            $('#username').keyup(function(){
                $.ajax({
                    url: "auth.php",
                    method: "post",
                    data: $('form').serialize(),
                    dataType: "text",
                    success: function (response) {
                        $('#status').text(response);             
                    }
                });
            })

            $('#submit').click(function (e) { 
                e.preventDefault();
                $.ajax({
                    url: "auth1.php",
                    method :"post",
                    data: $('form').serialize(),
                    dataType: "text",
                    success: function (response) {
                        $('#status').text(response);
                        if(response != 'Something went wrong!!'){
                            setInterval(() => {
                                $('#already').click();
                            }, 2000);
                        }
                    }
                });
            });
        })
    </script>
</body>
</html>