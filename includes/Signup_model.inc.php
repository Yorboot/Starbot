<?php
declare(strict_types=1);

function get_username(object $pdo, string $username)
{
    
    $query = "SELECT username FROM users WHERE username = :username;";
    //perpare querry
    $stmt = $pdo->prepare($qeury);

    $stmt->bindParam(":username",$username);

    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}
function getEmail(object $pdo, string $email)
{
    
    $query = "SELECT email FROM users WHERE email = :email;";
    //perpare querry
    $stmt = $pdo->prepare($qeury);

    $stmt->bindParam(":username",$username);

    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}