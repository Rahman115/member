<?php 

session_start();
if(!isset($_SESSION['username_member'])){
    header("Location: login.php");
    exit();
}

?>