<?php 
    if(!isset($_SESSION)) {
        session_set_cookie_params(0);
        session_start();
    } 

    if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true){
        header("location:login.php");
        exit();
    } else {
        header("location:acceuil.php");
        exit();
    }
?>
<?php include "./layout/header.php" ?>


<?php include "./layout/footer.php" ;?>