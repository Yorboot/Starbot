<?php
echo $_SESSION['Loged_In'];
session_unset();
session_destroy();

if (!isset($_SESSION['Loged_In'])||!$_SESSION['Loged_In']) {header("Location:../../../index.php");}
