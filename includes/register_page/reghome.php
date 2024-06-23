<?php require_once("../dbh.inc.php");
// email err = check if email is valid or is not empty  PswErrAz = check the password contains atleast one letter PswErrN = check if the password contains numbers PswErrE = checks if both passwords are the same = Demail = check if the email is a duplicate
$emailErr = $PswErrAz = $PswErrN = $PswErrE = $Vemail = $Demail = $PswL = "";
$err_array = array('emailErr' => '', 'PswErrAz' => '', 'PswErrE' => '', 'Vemail' => '', 'Demail' => '', 'PswErrN' => '','PswL'=>'');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        function Cinput($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        if (isset($_POST["email"]) && isset($_POST["psw"]) && isset($_POST["Rpsw"])) {
            $email = Cinput($_POST["email"]);
            if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                $err_array['Vemail'] = '';
            } else {
                $err_array['Vemail'] = "A valid email must be provided";
            }
            if (strlen($_POST["psw"]) <= 8) {
                $err_array['PswErrL'] = "Your Password must be atleast 8 characters long";
            } elseif (!preg_match("/[a-z]/i", $_POST["psw"])) {
                $err_array['PswErrAz'] = "Your password must contain one letter atleast";
            } elseif (!preg_match("/[0-9]/i", $_POST["psw"])) {
                $err_array['PswErrE'] = "Your password should atleast contain one number";
            }
            $psw = Cinput($_POST["Psw"]);
            $Rpsw = Cinput($_POST["Rpsw"]);
            if($psw !=$Rpsw){
                $err_array['PswErrE']= "Both passwords need to be the same";
            }
        }
        $cost = 15;
        $hashOptions = ['cost' => $cost];
        $psw_hash = password_hash($psw, PASSWORD_BCRYPT, $hashOptions);
        $stmt = $pdo->prepare("INSERT INTO users(email,password_hash) VALUES(:email,:password_hash)");

        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password_hash', $psw_hash);

        $stmt->execute();
        header("location:../extra-pages/registerSucess/registerSucess.html");
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
                <span><?php echo $err_array['Vemail']; ?></span>
            </label>
            <label for="psw">
                <input class="Inputs Verify" type="password" placeholder="Enter Password" id="psw" name="psw" value ="<?php $psw ?>">
                <span><?php echo $err_array['PswErrAz']; ?></span>
                <span><?php echo $err_array['PswErrN']; ?></span>
                <span><?php echo $err_array['PswL'];  ?></span>
            </label>
            <label for="Rpsw">
                <input class="Inputs Verify" type="password" placeholder="Confirm Password" id="Rpsw" name="Rpsw" value = "<?php $Rpsw?>">
                <span class = "Errors"><?php echo $err_array['PswErrE']; ?></span>
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
            <span>Already have an acount?<a href="../extra-pages/Login/index.html">Login</a></span>
        </div>
    </form>
</main>
</body>
<script>
    let Verify = document.getElementsByClassName('Verify');
              for(let i = 0; i< Verify.length;i++)
              {
                  verify[i].onclick = function (){resetErrors(this);};
                  verify[i].onchange = function (){verifyData(this,this.name);}
              }
    function resetErrors(inputElement) {
        inputElement.nextElementSibling.innerHTML = '';
    }
    function verifyData(item,dataType) {
        switch(dataType){

        case 'email':
        if(!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(item.value)){
            item.nextElementSibling.innerHTML = 'A non valid email hase been provided'
        }
        break;

        case 'Psw':
            if(item.value.length <= 8){
                item.nextElementSibling.innerHTML = "Your password must be atleast 8 characters"
            }
            break;
        case 'Rpsw':
            if(!item.value == document.getElementById('c_pass1.value')){
                item.nextElementSibling.innerHTML = "The passwords dont match";
            }
            break;
        }
    }

</script>
</html>