<?php
if(session_status() == PHP_SESSION_NONE){session_start();}
if($_SERVER["REQUEST_METHOD"]== "POST"){
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
$_SESSION = array();
session_destroy();
}

if (!isset($_SESSION['Loged_In'])) {header("Location:../../../index.php");}
