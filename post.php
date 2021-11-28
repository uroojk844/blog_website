<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>About</title>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/w3.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
</head>

<body>
    <div id="ttl" class="w3-bar w3-card">
        <a href="index.php">
            <div class="w3-bar-item w3-padding-16">Mariyam's Diary</div>
        </a>
        <a href="logout.php">
            <div class="w3-bar-item w3-padding-16 w3-right">
                <i class=" fa fa-power-off"></i>
            </div>
        </a>
    </div>

    <div class="w3-margin-top w3-row-padding" id="centered">
        <div class="w3-col l2 m2 w3-padding"></div>
        <div class="w3-col m8 l8 s12">
            <form action="action.php" method="POST">
            <div>
                <h3>Category</h3>
                <select class="border w3-padding w3-round w3-block" name="cat">
                    <option value="romantic">Romantic</option>
                    <option value="nature">Nature</option>
                    <option value="brokenHeart">Broken Heart</option>
                    <option value="depressive">Depressive</option>
                </select>
            </div>

            <div>
                <h3>Title</h3>
                <input id="input" class="border w3-padding w3-round w3-block" name="title">
            </div>

            <div class="w3-margin-bottom">
                <h3>Content</h3>
                <textarea id="textarea" rows="8" class="border w3-padding w3-round w3-block" name="poetry"></textarea>
            </div>

            <input type="submit" class="w3-button w3-round w3-hover-black">
            </form>
        </div>
    </div>
</body>

</html>