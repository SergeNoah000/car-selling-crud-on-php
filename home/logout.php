<?php
session_start();
$_SESSION['login']=null;
$_SESSION = null;
session_destroy();
header("Location:./index.php");
?>
