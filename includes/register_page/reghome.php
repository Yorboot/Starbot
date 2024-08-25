<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
global $pdo;
require_once "../dbh.inc.php";
require_once "../../vendor/autoload.php";
require_once "../Encrypt.php";
if (!isset($_SESSION['Err'])) {
    $_SESSION['Err'] = '';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        //function to clean up inputs
        function Cinput($data):string
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        //check if no fields are left empty
        if (isset($_POST["email"]) && isset($_POST["psw"]) && isset($_POST["Rpsw"])) {
            $email = Cinput($_POST["email"]);
            $psw = Cinput($_POST["psw"]);
            $Rpsw = Cinput($_POST["Rpsw"]);
            $_SESSION['Loged_In'] = false;
            if($email == "" || $psw == "" || $Rpsw == ""){
                header("location: reghome.php");
            }elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                $_SESSION['Err'] = "Please enter a valid email address";
                exit;
            } elseif (strlen($_POST["psw"]) <= 8) {
                $_SESSION['Err'] = "Your password must be at least 8 characters long";
                exit;

            } elseif (!preg_match("/[a-z]/i", $_POST["psw"])) {
                $_SESSION['Err'] = "Your password must contain at least one letter";
              exit;
            } elseif (!preg_match("/[0-9]/i", $_POST["psw"])) {
                $_SESSION['Err'] = "Your password must contain at least one number";
                exit;
            } elseif($psw !=$Rpsw){
                exit;
            }else{
                //checks for a duplicate email
                $stmt = $pdo->prepare("SELECT* FROM users WHERE email = :email;");
                $stmt->bindParam(':email',$email);
                $stmt->execute();
                $stmt->fetch();
                if($stmt->rowCount()>0){
                    $_SESSION["Err"]= "Email already exists";
                    header("Location: reghome.php");
                }else{
                    //actually registering the user
                    $cost = 15;

                    $hashOptions = ['cost' => $cost];
                    $psw_hash = password_hash($psw, PASSWORD_BCRYPT, $hashOptions);
                    $stmt = $pdo->prepare("INSERT INTO users(email,password_hash ) VALUES(:email,:password_hash)");

                    $stmt->bindParam(':email', $email);
                    $stmt->bindParam(':password_hash', $psw_hash);
                    if($stmt->execute()){
                        $_SESSION['Loged_In'] = true;
                        $_SESSION['id'] = session_id();
                        $_SESSION['email'] = $email;
                        $_SESSION['psw'] = $psw_hash;
                        header('Location: ../../index.php');
                        exit();
                    }else{
                        $_SESSION["Err"] = "Something went wrong please try again";
                        exit();
                    }

                }
            }

            exit();
        }else{
            header('Location: reghome.php');
            exit();
        }

    } catch (PDOException $Exception) {
        throw new PDOException($Exception->getMessage(), (int)$Exception->getCode());
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
    <link rel="stylesheet" href="../normalize.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<!--123456fg -->
<main class="Container">

    <form method="post" class="Modal" action="reghome.php">
        <div class="Flex FD">
            <h1 class="Title">Welcome!</h1>
            <label for="email">
                <input class="Inputs Verify" type="email" placeholder="Enter email" id="email" name="email">
            </label>
            <label for="psw">
                <input class="Inputs Verify" type="password" placeholder="Enter Password" id="psw" name="psw" autocomplete="off">
            </label>
            <label for="Rpsw">
                <input class="Inputs Verify" type="password" placeholder="Confirm Password" id="Rpsw" name="Rpsw" autocomplete="off">
            </label>
            <span id = "Err"><?php echo $_SESSION['Err']?></span>
            <button type="submit" class="Submit">Register</button>
        </div>
        <div class="Flex">
            <div class="Line"></div>
            <div class="OlwT">Or Register With</div>
            <div class="Line"></div>
        </div>
        <div>
            <ul class="Boxes FlexB">
                <li class=""><a href=""><img src="../../images/facebook.png" alt="" class="facebook"></a></li>
                <li class="Mb"><a href=""><img src="../../images/search.png" alt="" class="Google"></a></li>
                <li class=""><a href=""><img src="../../images/user.png" alt="" class="Img"></a></li>
            </ul>
        </div>
        <div class="Flex FgtPsw">
            <span>Already have an acount?<a href="../extra-pages/Login/index.php">Login</a></span>
        </div>
    </form>
</main>
</body>

</html>