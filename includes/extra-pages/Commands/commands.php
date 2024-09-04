<?php
     if(session_status() == PHP_SESSION_NONE){session_start();}
     if(!isset($_SESSION['Loged_In'])){$_SESSION['Loged_In']='';}
     if(!$_SESSION['Loged_In']){session_destroy();}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Commands</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="icon" href="../../../images/favcon.png">
    <link rel='stylesheet' type='text/css' media='screen' href='commands.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../../normalize.css'>
    <script src="index.js"></script>
</head>

<body>
    <header class="Head">
        <div class="Navbar">
            <ul class="nav">
                <li><a href="../../../index.php" class="nav-link nav-link-ltr">Main</a></li>
                <li><a class="nav-link nav-link-ltr">Dashboard</a></li>
                <li><a href="commands.html" class="nav-link nav-link-ltr">Commands</a></li>
                <li><a href="" class="nav-link nav-link-ltr">Github</a></li>
                <li><a class="nav-link nav-link-ltr flt-right Lgmb fw"
                       style="
                       display: <?php echo $a = !$_SESSION['Loged_In'] ? 'block' : 'none'; ?>"
                       id = "Login"
                       href="includes/extra-pages/Login/index.php">

                    <?php if(!$_SESSION['Loged_In']){echo 'Login';}else{echo '';} ?></a></li>

                <li><a class= "nav-link nav-link-ltr flt-right Lgmb fw " id = "Profile" href="includes/extra-pages/profile/index.php">Profile</a></li>
            </ul>
        </div>
    </header>
    <main>
        <h1 class="Title">Commands</h1>
    </main>
    <footer>
        <span class = "Disc"><a class="DiscTxt"><img src="../../../images/discord.png" alt="discord icon" class="DiscImg"></a></span>
    </footer>
</body>

</html>