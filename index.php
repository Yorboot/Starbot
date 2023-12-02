<?php 
    require_once('includes/Session_config.inc.php')
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
    <link rel="stylesheet"href="node_modules/normalize.css/normalize.css">
    <!--Favcon-->
    <link rel="icon" href="images/favcon.png">
    <!--Main js file-->
    <script src="index.js"></script>
    <!--Extra js file-->
    <script src = "includes/index.js"></script>
</head>

<body>
    <header class="Head">
        <div class="Navbar">
            <ul class="nav">
                <li><a href="#main" class="nav-link nav-link-ltr">Main</a></li>
                <li><a class="nav-link nav-link-ltr">Dashboard</a></li>
                <li><a href = "includes/extra pages/Commands/commands.php" class="nav-link nav-link-ltr">Commands</a></li>
                <li><a href="https://github.com/Roy123132123/Starbot" class="nav-link nav-link-ltr">Github</a></li>
                <!--Lgmb = Login main button-->
                <li><button class="nav-link nav-link-ltr flt-right Lgmb fw"onclick="document.getElementById('m1').style.display = 'block'">Login</button></li>
            </ul>
        </div>
    </header>
    <main id="Main">
        <div class="Flex-container">
            <div class="Main-text">
                <h1 class="Title">Starbot</h1>
                <span>&copy;Star-Bot 2023</span>
            </div>
        </div>
    </main>
    <div class="flex">
    <div class="Modal" id="m1">
        <form class="modal-content animate" action="includes/login.inc.php" method="post">
            <div class="modal-imgcontainer">
                <span onclick="document.getElementById('m1').style.display = 'none'" class="close"
                    title="Close modal"></span>
                <img src="images/user.png" alt="Avatar" class="avatar">
            </div>
            <div class="modal-container margin-top">
                <!--Username-->
                <label for="Uname"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="uname" id="Uname" required>
                <!--Email-->
                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Enter email" name="email" id="email" required>
                <!--Password-->
                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter password" name="psw" id="psw" required>
                <!--Login buton-->
                <button type="submit" class="Login fw">Login</button>
                <!--Remember me button-->
                <label>
                    <input class = "Rmb" type="checkbox" checked="checked" name="remember">Remember me
                </label>
            </div>
            <div class="modal-container" style="background-color: #f1f1f1">
                <button type="button" onclick="document.getElementById('m1').style.display = 'none'"
                    class="cancelbtn fw">Cancel</button>
                <div class = "flex-inline">
                <span class="reg"><a href = 'includes/register_page/reghome.html' class = "reg fw">Register</a></span>
                <span class="psw fw"><a>Forgot password?</a></span>
                </div>
            </div>
        </form>
        </div>
    </div>
    <footer class="ftr">
        <span><a class="DiscTxt"><img src="images/discord.png" alt="discord icon"class="DiscImg"></a></span>
    </footer>
</body>

</html>