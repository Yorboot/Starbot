<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
    function connectdb(){
    //set al variables to acces database
    $dsn = "mysql:host=localhost;dbname=starbot";
    $dbusername = "root";
    $dbpassword = "";
    //try to create a new pdo object and catch any errors if they occur if so then echo them out
    try{
        $pdo = new PDO($dsn, $dbusername,$dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e){
        echo "connection failed".$e->getMessage();

    }
    }
    $email = _POST[$email];
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $emailErr = "Invalid email format";
    } else{
        connectdb();
    }
}else{
    header("Location: reghome.php ");
}
