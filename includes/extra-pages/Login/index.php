<?php
session_start();
$emailErr = $pswErr = '';
$errArray = array('emailErr'=>'','pswErr'=> '');
$errors = isset($_SESSION['errors'])?$_SESSION['errors']:$errArray;
require_once("../../dbh.inc.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 try {

     function Cinput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $email = Cinput($_POST['email']);
    $password = Cinput($_POST['psw']);
    $stmt = $pdo->prepare("SELECT psw FROM users WHERE email = :email");
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user && password_verify($password, $user["psw"])) {
        $_SESSION['Loged_In'] = false;
        $_SESSION['id'] = session_id();
        $_SESSION["email"] = $email;
        $_SESSION['psw'] = $password;
        header("location:../../../index.php");
        exit();
    }elseif(!password_verify($password, $user["psw"])){
       $errArray['pswErr'] = "Password invalid";
    }elseif($user == null){
        $errArray['emailErr']= "This email isnt connected to an acount";
        
    }
    $_SESSION['errors'] = $errArray;
 } catch (PDOException $e) {
    die("connection failed". $e->getMessage());
 }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="../../images/favcon.png">
    <link rel="stylesheet" href="../../node_modules/normalize.css/normalize.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main class="Container">
        <form method="POST" class = "Modal" action="index.php">
            <div class ="Flex FD">
                <h1 class="Title">Welcome back!</h1>
                <label for="email">
                    <input class="Inputs" type="text" placeholder="Enter email" name = "email">
                    <span id = "email"><?echo $errArray['emailErr']; ?></span>
                    <br>
                </label>
                <label for="psw">
                    <input class="Inputs" type="password" placeholder="Enter Password" name = "psw">
                    <br>
                    <span id="psw"><?echo $errArray['pswErr']; ?></span>
                </label>
                <button type="submit" class="Submit">Login</button>
            </div>
            <div class="Flex">
                <div class="Line"></div>
                <div class="OlwT">Or Login With</div>
                <div class="Line"></div>
            </div>
            <div>
                 <ul class="Boxes FlexB">
                    <li class=""><a href=""><img src="../../../images/facebook.png" alt="" class="facebook"></a></li>
                    <li class="Mb"><a href=""><img src="../../../images/search.png" alt="" class="Google"></a></li>
                    <li class=""><a href=""><img src="/images/discord.png" alt="" class="Img"></a></li>
                </ul>
            </div>
            <div class="Flex FgtPsw">
                <span>Don't have an acount?<a href="../../register_page/reghome.php">SignUp</a></span>
            </div>
        </form>
    </main>
</body>
</html>