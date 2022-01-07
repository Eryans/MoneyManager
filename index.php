<?php 
    ob_start();

    if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true){
        header("location:login.php");
        exit();
    } else {
        header("location:acceuil.php");
        exit();
    }
    $content = ob_get_clean();
    require_once "./layout/template.php";
