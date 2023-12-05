<?php


if($_SERVER["REQUEST_METHOD"] == "POST"){
        $uname = $_POST["uname"];
        $email = $_POST["email"];
        $psw = $_POST["psw"];
        try {
            require_once 'dbh.inc.php';
            require_once 'Signup_model.inc.php';
            require_once 'Signup_cntr.inc.php';
            require_once 'Session_config.inc.php';
            //error handlers
            $errors = [" "];
            if(isInputEmpty($username,$psw,$email)){
                $errors["EmptyInput"] = "Fill in all fields";
            }
            if(isEmailValid($email)){
                $errors["EmailInvalid"]= "Email invalid email form";
            }
            if(is_Username_taken( $pdo, $username)){
                $errors["UsernameTaken"] = "This Username hase been taken";
            }
            if(is_Email_taken($pdo,$email)){
                $errors["EmailTaken"] = "This email hase already been used";
            }

            if($errors){
                $_SESSION["errors_signup"] = $errors;
                header("Location:includes/register_page/reghome.php");
            }
        } catch (PDOException $e) {
            die("Quarry failed". $e ->getMessage());
    }
}else{
    header("location: http://localhost/Starbot/index.php");
}