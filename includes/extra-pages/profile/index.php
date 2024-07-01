<?php
session_start();
require_once "../../dbh.inc.php";
require_once "../../keys.php";
if(!isset($_SESSION['id'])){
    header("Location:../Login/index.php");
    exit;
}
$id = $_SESSION['id'];
try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id=:id");
    
} catch (\Throwable $th) {
    //throw $th;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main class="container">
        <h1>Welcome, <?php echo htmlspecialchars($user['name']); ?>!</h1>
        <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
        <p>Password_hash: <?php echo htmlspecialchars($user['password_hash']); ?></p>
        
        <a href="logout.php">Logout</a>
    </main>
</body>

</html>