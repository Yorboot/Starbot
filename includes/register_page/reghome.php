<?php
session_start();
require_once "../dbh.inc.php";
require_once "../../vendor/autoload.php";
require_once "../Encrypt.php";
use Dotenv\Dotenv;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        //function to clean up inputs
        function Cinput($data)
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
            if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                exit;
            } elseif (strlen($_POST["psw"]) <= 8) {
                exit;

            } elseif (!preg_match("/[a-z]/i", $_POST["psw"])) {
              exit;
            } elseif (!preg_match("/[0-9]/i", $_POST["psw"])) {
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
                    $err_array["Demail"]= "Email already exists";
                }else{
                    //actually registering the user
                    $cost = 15;

                    $hashOptions = ['cost' => $cost];
                    $psw_hash = password_hash($psw, PASSWORD_BCRYPT, $hashOptions);
                    $stmt = $pdo->prepare("INSERT INTO users(email,password_hash ) VALUES(:email,:password_hash)");

                    $stmt->bindParam(':email', $email);
                    $stmt->bindParam(':password_hash', $psw_hash);
                    $stmt->execute();
                    
                    //loging the user in after registering
                    $stmt = $pdo->prepare("SELECT id,password_hash FROM users WHERE email= :email");
                    $stmt -> bindParam(":email",$email);
                    $stmt -> execute();
                    $user = $stmt ->fetch();
                    if($user){
                        $_SESSION['Loged_In'] = true;
                        $id = Encrypt($user['id']);
                        $_SESSION['id'] = $id;
                        $_SESSION['Psw'] = $user['password_hash'];
                        $_SESSION['email'] = $user['email'];
                        header("Location: ../../index.php");
                        exit;
                    }
                    exit;
                }
            }
            $_SESSION['form_data'] = $_POST;
            exit;
        }

    } catch (PDOException $Exception) {
        throw new PDOException($Exception->getMessage(), (int)$Exception->getCode());
    }
    $form_data = isset($_SESSION['$form_data']) ? $_SESSION['$form_data'] : array('email' => '', 'psw' => '', 'Rpsw' => '');
    $email = isset($_POST['email']);
    $psw = isset($_POST['psw']);
    $Rpsw = isset($_POST['Rpsw']) ;

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
<!--123456fg -->
<main class="Container">

    <form method="post" class="Modal" action="reghome.php">
        <div class="Flex FD">
            <h1 class="Title">Welcome!</h1>
            <label for="email">
                <input class="Inputs Verify" type="email" placeholder="Enter email" id="email" name="email" value = "<?php $email ?>">
                <br>
                <span id = "Email"></span>
            </label>
            <label for="psw">
                <input class="Inputs Verify" type="password" placeholder="Enter Password" id="psw" name="psw" autocomplete="off">
                <br>
                <span id = "Psw1"></span>
                <br>
                <span id = "Psw2"></span>
            </label>
            <label for="Rpsw">
                <input class="Inputs Verify" type="password" placeholder="Confirm Password" id="Rpsw" name="Rpsw" autocomplete="off">
                <br>
                <span id = "rpsw"></span>
            </label>
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
<script>
    document.addEventListener('DOMContentLoaded',function(){
        const verifyElements = document.querySelectorAll('.Verify');
        verifyElements.forEach(element =>{
            element.addEventListener('click',()=>resetErrors(element));
            element.addEventListener('change',()=>verifyData(element,element.name));
        })
    })
    function resetErrors(inputElement) {
        inputElement.nextElementSibling.innerHTML = '';
        document.getElementById('Psw2').innerHTML = '';
    }
    function verifyData(item,dataType) {
        switch(dataType){

        case 'email':
        if(!/^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(item.value)){
            document.getElementById('Email').innerHTML = 'A non valid email hase been provided'
        }else{
            document.getElementById('Email').innerHTML = ''
        }
        break;

        case 'psw':
            if(item.value <= 8){
                document.getElementById('Psw1').innerHTML = "Your password must be atleast 8 characters"
            }else if(!/[a-zA-Z]/.test(item.value)){
                document.getElementById('Psw2').innerHTML = "Your password should atleast contain one letter"
                document.getElementById('Psw1').innerHTML = '';
            }
            break;
        case 'Rpsw':
            if(document.getElementById('psw').value !== document.getElementById('Rpsw').value){
                document.getElementById('rpsw').innerHTML = "The passwords dont match";
            }else{
                document.getElementById('rpsw').innerHTML = '';
            }
            break;
        }
    }

</script>
</html>