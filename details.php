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
    try {
        $sql = "SELECT *,cp.id as cID, cp.nom as cNom FROM compte as cp INNER JOIN client as cl ON cp.clientID = cl.id WHERE clientID = :id AND cp.id = :cID";
        $stmt = $db->prepare($sql);
        $stmt->execute(["id" => $_SESSION["userID"], "cID" => $_GET["id"]]);
        $account = $stmt->fetch();
    } catch (PDOException $error) {
        echo "Something went wront : $error";
    }
    /* --------OPERATION INFO SQL--------- */
    try {
        $opSql = "SELECT * FROM operation as op INNER JOIN compte as c ON op.compte_ID = c.id ORDER BY op.id DESC";
        $opStmt = $db->prepare($opSql);
        $opStmt->execute();
        $operations = $opStmt->fetchAll();
        // SQL request must be assigned to variable in order to put them in a string. 
        // I don't know why it will cause an error if i just write them directly.
        $opType = $operations[0]['type'];
        $opDate = $operations[0]['date_creation'];
        $opDescrpt = $operations[0]['description'];
        $opAmount = $operations[0]['amount'];
        $opStatus = $operations[0]['status'];
        $opPaymentRcv = $operations[0]['payment_receiver'];
        // Since we receive the operations in descending order index 0 is always the last one
        $last_operation = "| $opDate | $opType de $opAmount € $opDescrpt $opPaymentRcv | Statut : $opStatus";
        // TO DO : Make some operation before testing to fill operation table
    } catch (PDOException $error) {
        echo "Something went wront : $error";
    }

    if ($stmt->rowCount() > 0) {
        $card = new Card(FALSE, $account["id"], $account["cNom"], $account["numero"], $account["nom"] . " " . $account["prenom"], $account["solde"], $last_operation, $account["date_creation_compte"]);
        $card->show_card();
    } else {
        echo "<h2>ERROR TRYING TO ACCESS ACCOUNT</h2>";
    }
} else {
    echo "<h2>You must be logged in to acces this page.</h2>";
}


?>

<?php include "layout/footer.php" ?>