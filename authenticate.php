<?php
session_start();

if(!isset($_SESSION["username"])){
header("Location: uiupdate.php");
exit(); }



?>
