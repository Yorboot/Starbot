<?php
if(session_status() == PHP_SESSION_NONE){session_start();}

require_once "./includes/dbh.inc.php";
if(!isset($_SESSION['Loged_in'])){$_SESSION['Loged_in']='';}
if(!$_SESSION['Loged_In']){session_destroy();}

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
    <link rel="stylesheet" href="includes/normalize.css">
    <!--Favcon-->
    <link rel="icon" href="./images/favcon.png">
    <!--Main js file-->
    <script src="index.js" defer></script>
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
                <li><a class="nav-link nav-link-ltr flt-right Login Lgmb fw"
                       style="
                       display: <?php echo $a = !$_SESSION['Loged_In'] ? 'block' : 'none'; ?>"
                        id = "Login"
                       href="includes/extra-pages/Login/index.php">

                    <?php if(!$_SESSION['Loged_In']){echo 'Login';}else{echo '';} ?></a></li>

                <li><a class= "nav-link nav-link-ltr flt-right Lgmb fw " id = "Profile" href="includes/extra-pages/profile/index.php">Profile</a></li>
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
        <span><a class="DiscTxt"><img src="./images/discord.png" alt="discord icon" class="DiscImg"></a></span>
    </footer>
</body>
</html>