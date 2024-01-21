 <?php 
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST["email"];
    $password = $_POST["password"];
    $dbcon = require_once "dbh.inc.php";

    $stmt = sprintf("SELECT* FROM users WHERE email ='%s'",$pdo->quote($email));
   $result = $mysqli->query($sql);
   $user = $result->fetch_assoc();
   if($user){
    password_verify($password,$user["password_hash"]);
   }
} else{
    header("Location: ../index.html");
}
