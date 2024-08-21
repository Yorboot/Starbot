session_start();
global $pdo;
require_once "../../dbh.inc.php";
/* if(!isset($_SESSION['id'])){
    header("Location:../Login/index.php");
    exit;

}
*/
//$id = $_SESSION['id'];
/* try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id=:id");
    
} catch (PDOException $e) {
    die("connection failed". $e->getMessage());
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../../normalize.css">
</head>

<body>
        <header class = "Header">
            <div class="flex Navbar">
                <ul class="nav">
                    <li>
                        <a class="nav-link">Profile</a>
                    </li>
                </ul>
            </div>
        </header>
    <main>
    <div class="main container">
        <h1>Welcome,!</h1>
        <p>Email:</p>
        <p>Password_hash:</p>
    </div>
        <a class="Bottom" href="../Logout/logout.php">Logout</a>
    </main>
</body>

</html>