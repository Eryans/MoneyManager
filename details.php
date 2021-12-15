<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<?php include "layout/header.php" ?>

<?php

if (!empty($_SESSION["logged_in"]) && $_SESSION["logged_in"]) {
    
    require "model/model.php";
    require "components/cards.php";

/* --------GLOBAL INFO SQL--------- */
    try{
        $sql = "SELECT *,cp.id as cID, cp.nom as cNom FROM compte as cp INNER JOIN client as cl ON cp.clientID = cl.id WHERE clientID = :id AND cp.id = :cID";
        $stmt = $db->prepare($sql);
        $stmt->execute(["id" => $_SESSION["userID"],"cID" => $_GET["id"]]);
        $account = $stmt->fetch();
    } catch(PDOException $error) {
        echo "Something went wront : $error";
    }
/* --------OPERATION INFO SQL--------- */
    try{
        $opSql = "SELECT * FROM operation as p INNER JOIN compte as c ON operation.compte_ID = c.id";
        // TO DO : Make some operation before testing to fill operation table
    }catch(PDOException $error) {
        echo "Something went wront : $error";
    }

    if ($stmt->rowCount() > 0){
        $card = new Card(FALSE,$account["id"],$account["cNom"],$account["numero"],$account["nom"],$account["solde"],"None",$account["date_creation_compte"]);
        $card->show_card();
    } else {
    echo "<h2>ERROR TRYING TO ACCESS ACCOUNT</h2>";
    }
} else {
    echo "<h2>You must be logged in to acces this page.</h2>";
}


?>

<?php include "layout/footer.php" ?>