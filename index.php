<?php 
    $login = require_once "login.inc.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!--Usual technical meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MainPage</title>
    <!--Main css file-->
    <link rel="stylesheet" href="style.css">
    <!--Css file to normalize all browsers settings across all browers-->
    <link rel="stylesheet" href="node_modules/normalize.css/normalize.css">
    <!--Favcon-->
    <link rel="icon" href="images/favcon.png">
    <!--Main js file-->
    <script src="index.js"></script>
</head>

<body>
    <header class="Head">
        <div class="Navbar">
            <ul class="nav">
                <li><a href="index.php" class="nav-link nav-link-ltr">Main</a></li>
                <li><a class="nav-link nav-link-ltr">Dashboard</a></li>
                <li><a href="/includes/extra-pages/Commands/commands.html" class="nav-link nav-link-ltr">Commands</a>
                </li>
                <li><a href="https://github.com/Roy123132123/Starbot" class="nav-link nav-link-ltr">Github</a></li>
                <!--Lgmb = Login main button-->
                <li><a class= "nav-link nav-link-ltr flt-right Lgmb fw" href="includes/extra-pages/Login/index.html">Login</a></li>
            </ul>
        </div>
    </header>
    <main id="Main">
        <div class="Flex-container">
            <div class="Main-text">
                <h1 class="Title">Starbot</h1>
                <span>&copy;Star-Bot 2024</span>
            </div>
        </div>
    </main>

    <footer class="ftr">
        <span><a class="DiscTxt"><img src="images/discord.png" alt="discord icon" class="DiscImg"></a></span>
    </footer>
</body>

</html>