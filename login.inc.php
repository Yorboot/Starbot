<?php
session_start();
$is_invalid = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["psw"];
    $dbcon = require_once "includes/dbh.inc.php";

 try {
    $stmt = $pdo->prepare("SELECT* FROM users WHERE email =:email");
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user && password_verify($password, $user["password_hash"])) {
        $_SESSION["email"] = $email;
        header("location:index.php");
        exit();
    }else{
        $is_invalid = true;
    }
 } catch (PDOException $e) {
    die("connection failed". $e->getMessage());
 }
} else {

}
