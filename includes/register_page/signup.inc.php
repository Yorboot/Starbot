<?php
$dbconnection = require_once "../dbh.inc.php";
$email = $_POST["email"];
$password = $_POST["psw"];
if(empty($_POST["email"])){
    die("fill in a email");
} elseif (empty($_POST["psw"])) {
   die("fill in a password");
} elseif (empty($_POST["Rpsw"]) ){
    die("repeat your passwoord dont leave it empty");
}
//filter_var returns false if a not valid email is submited
if(! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
    die("Valid email is required");
}
if(strlen($_POST["psw"])<8){
    die("Password must be atleast 8 characters long");
}

if(!preg_match("/[a-z]/i", $_POST["psw"])){
    die("The password must contain one letter atleast");
}
if(!preg_match("/[0-9]/i", $_POST["psw"])){
    die("The password must contain atleast one number");
}
if($_POST["psw"] !== $_POST["Rpsw"]){
    die("The passwords arent the same");
}
$cost = 15;
$hashOptions = ['cost' => $cost];

try {
$psw_hash = password_hash($_POST["psw"], PASSWORD_BCRYPT,$hashOptions);

$stmt = $pdo->prepare("INSERT INTO users(email,password_hash) VALUES(:email,:password_hash)");

$stmt ->bindParam(':email',$email);
$stmt ->bindParam(':password_hash',$psw_hash);

$stmt->execute();
header("location:../extra pages/registerSucess/registerSucess.html");
} catch (PDOException $Exception) {
    $Exception->getMessage();
}