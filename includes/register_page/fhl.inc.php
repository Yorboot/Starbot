<?php
    require_once "../dbh.inc.php";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $uname = $_POST["uname"];
        $email = $_POST["email"];
        $psw = $_POST["psw"];

        try {

            $qeury = "INSERT INTO users (username, email,psw) VALUES(:uname, :email,:psw);";

            $stmt = $pdo->prepare($qeury);

            $hashOptions = [
                'cost' => 15
            ];
            $pswhashed = password_hash($psw, PASSWORD_BCRYPT,$hashOptions);

            // name all params
            $stmt->bindParam("uname", $uname);
            $stmt->bindParam("email", $email);
            $stmt->bindParam("psw", $pswhashed);
            //push the query to database
            $stmt->execute();
            //set database connection and statement to null
            $pdo = null;
            $stmt = null;
            header("Location: ../extra pages/registerSucess/registerSucess.php");
            die();
        } catch (PDOException $e) {
             die("Quarry failed". $e ->getMessage());
        }
    } else {
        header("location: reghome.php");
        die();
    }