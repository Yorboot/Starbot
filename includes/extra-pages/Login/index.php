<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
global $pdo;

$Err = function () {
    if (!isset($_SESSION['Err'])) {
        $_SESSION['Err'] = '';
    }
};
require_once(__DIR__ . '/../../dbh.inc.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {

        function Cinput($data): string
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        if (isset($_POST['email']) && isset($_POST['psw'])) {
            $_SESSION['Loged_In'] = false;
            $email = Cinput($_POST['email']);
            $password = Cinput($_POST['psw']);
            $stmt = $pdo->prepare("SELECT password_hash FROM users WHERE email = :email");
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);


            if ($user != null && password_verify($password, $user["password_hash"])) {
                $_SESSION['Loged_In'] = true;
                $_SESSION['id'] = session_id();
                $_SESSION["email"] = $email;
                $_SESSION['psw'] = $user['password_hash'];

                header("Location: ../../../index.php");
                exit();
            }elseif ($user == null) {
                $_SESSION['Err'] = "This email isnt connected to an acount";
            } elseif (!password_verify($password, $user["password_hash"])) {
                $_SESSION['Err'] = "Password invalid";
            }

        }


    } catch (PDOException $e) {
        die("connection failed" . $e->getMessage());
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="../../../images/favcon.png">
    <link rel="stylesheet" href="../../normalize.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main class="Container">
        <form method="POST" class="Modal" action="index.php">
            <div class="Flex FD">
                <h1 class="Title">Welcome back!</h1>
                <label for="Email">
                    <input class="Inputs" type="text" placeholder="Enter email" name="email" id = "Email">
                    <br>
                </label>
                <label for="Psw">
                    <span><input class="Inputs" type="password" placeholder="Enter Password" name="psw"
                            id="Psw"><input class="Togel" id="Togel" type="checkbox" onclick="Click()"></span>
                    <script>
                        let input = document.getElementById("Psw");
                        function Click() {
                            if (input.type === "password") {
                                input.type = "text";
                            } else if (input.type === "text") {
                                input.type ="password";
                            }
                        }


                    </script>
                    <br>
                    <span><?php echo $_SESSION['Err'] ?></span>
                </label>
                <button type="submit" class="Submit">Login</button>
            </div>
            <div class="Flex">
                <div class="Line"></div>
                <div class="Olwt">Or Login With</div>
                <div class="Line"></div>
            </div>
            <div>
                <ul class="Boxes FlexB">
                    <li ><a href=""><img src="../../../images/facebook.png" alt="" class="facebook"></a></li>
                    <li class="Mb"><a href=""><img src="../../../images/search.png" alt="" class="Google"></a></li>
                    <li><a href=""><img src="../../../images/discord.png" alt="" class="Img"></a></li>
                    <li><a href="./Update_Psw.php" class="Up">Update</a></li>
                </ul>
            </div>
            <div class="Flex FgtPsw">
                <span>Don't have an acount?<a href="../../register_page/reghome.php">SignUp</a></span>
            </div>
        </form>
    </main>
</body>

</html>