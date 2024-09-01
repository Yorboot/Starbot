<?php
if(session_status() == PHP_SESSION_NONE){session_start();}
try {
    if (!isset($_SESSION['Loged_In'])||!$_SESSION['Loged_In']) {header("Location:../../../index.php");}
    session_unset();
    session_destroy();
   header("Location:../../../index.php");
}catch (Exception $e) {
    echo $e->getMessage();
}
