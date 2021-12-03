<?php include "layout/header.php"?>

<?php
require "components/cards.php";


if (!empty($_GET) && isset($_GET["name"],$_GET["number"],$_GET["owner"],$_GET["amount"],$_GET["lastOp"])){
    $name = htmlspecialchars($_GET["name"]);
    $number = htmlspecialchars($_GET["number"]);
    $owner = htmlspecialchars($_GET["owner"]);
    $amount = htmlspecialchars($_GET["amount"]);
    $lastOp = htmlspecialchars($_GET["lastOp"]);
} else {
    $error = "COMPTE BANCAIRE INEXISTANT";
}

if(isset($error)) {
    echo $error;
}
else {

    $card = new Card(FALSE,$name,$number,$owner,$amount,$lastOp);
    $card->show_card();
    
}

?>

<?php include "layout/footer.php"?>