<?php
global $pdo;
if(session_status() == PHP_SESSION_NONE){session_start();}
if(!isset($_SESSION['Loged_In'])){$_SESSION['Loged_In']='';}
require_once(__DIR__ . '/../../dbh.inc.php');
if($_SERVER["REQUEST_METHOD"]=="POST"){
    try {
        function Cinput($data): string {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $email = $_POST["Email"];
        $message = $_POST["Message"];
        $cemail = Cinput($email);
        $cmessage = Cinput($message);
        $_SESSION["Error"]= "";
        if(!isset($email)){
            $_SESSION["Error"]= "Please enter your email";
        }else if(!isset($message)){
            $_SESSION["Error"]= "Please enter a message";
        }
        $stmt=$pdo->Prepare("INSERT INTO contact (Email, Message) VALUES(:Email, :Message)");
        $stmt->bindParam(':Email', $cemail);
        $stmt->bindParam(':Message', $cmessage);
        $stmt->execute();
    }catch (Exception $e){
        echo $e->getMessage();
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../../normalize.css">
    <script src = "index.js" defer></script>
</head>
<body>
    <header class="Head">
        <div class="Navbar">
            <ul class="nav">
                <li><a href="../../../index.php" class="nav-link nav-link-ltr">Main</a></li>
                <li><a class="nav-link nav-link-ltr">Dashboard</a></li>
                <li><a href="/includes/extra-pages/Commands/commands.html" class="nav-link nav-link-ltr">Commands</a>
                </li>
                <li><a href="https://github.com/Roy123132123/Starbot" class="nav-link nav-link-ltr">Github</a></li>
                <!-- Lgmb = Login main button-->
                <li><a class="nav-link nav-link-ltr flt-right Login Lgmb fw"
                       style="
                           display: <?php echo $a = !$_SESSION['Loged_In'] ? 'block' : 'none'; ?>"
                       id = "Login"
                       href="../Login/index.php">

                    <?php if(!$_SESSION['Loged_In']){echo 'Login';}else{echo '';} ?></a></li>

                <li><a class= "nav-link nav-link-ltr flt-right Lgmb fw " id = "Profile" href="../profile/index.php">Profile</a></li>
                <li><a class= "nav-link nav-link-ltr " href="contact.php">Contact</a></li>
            </ul>
        </div>
    </header>
    <main class="flex">
        <form class="flex colum" method = "POST" action="contact.php">
            <h1 class="Text">Contact</h1>
            <label for="Email">
                <input type="text" placeholder="Enter email" id="Email" class="Inputs Padding Email" name = "Email">
            </label>
            <label for="Text">
                <textarea class = "Inputs Padding textbox" placeholder = "Enter message" id="Text" name="Message"></textarea>
            </label>
            <span><?php echo $_SESSION["Error"] ?></span>
            <button type="submit" id="Button">Submit</button>
        </form>
    </main>
</body>
</html>