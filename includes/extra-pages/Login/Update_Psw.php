<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST">
        
            <li><label for = "email"><input type="text" name = "email"></label></li>
            <li><label for =  "Psw"><input type="password" name = "Psw"></label></li>
            <li><button>submit</button></li>
            <?php
            global $pdo;
            require_once("../../dbh.inc.php");
                if($_SERVER['REQUEST_METHOD'] ==  "POST"){
                $email = $_POST["email"];
                $Psw = $_POST["Psw"];
                $cost = 15;
                //fj72
                $hashOptions = ['cost' => $cost];
                $psw_hash = password_hash($Psw, PASSWORD_BCRYPT, $hashOptions);
                $stmt = $pdo->prepare("UPDATE users SET password_hash = :password_hash WHERE email = :email");
                $stmt->bindParam("email", $email);
                $stmt->bindParam("password_hash", $psw_hash);
                $stmt->execute();
                }
            ?>
        </ul>
    </form>
</body>
</html>