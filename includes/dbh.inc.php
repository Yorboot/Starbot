<?php
$dsn = "mysql:host=localhost; dbname=starbot";
$dbusername = "root";
$dbpsw = "";
$pdo = "";
try {
    $pdo = new PDO($dsn,$dbusername,$dbpsw);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: ". $e ->getMessage();
}