<?php
if(session_status() == PHP_SESSION_NONE){session_start();}
if(!isset($_SESSION['id'])&&$_SESSION['Loged_in']) {
    header("Location:../Login/index.php");
    exit;
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../../normalize.css">
</head>

<body>
        <header class = "Header">
            <div class="flex Navbar">
                <ul class="nav">
                    <li>
                        <a class="nav-link">Profile</a>
                    </li>
                </ul>
            </div>
        </header>
    <main class ="Flex">
    <div>
        <h1>Welcome,!</h1>
        <p>Email: <?php echo $_SESSION['email'] ?></p>
        <p>Password_hash:<?php echo $_SESSION['psw'] ?></p>
    </div>
        <form method = "POST" action="../Logout/logout.php" class="Flex">
            <button type="submit" class="Bottom Logout">Logout</button>
        </form>
    </main>
</body>

</html>