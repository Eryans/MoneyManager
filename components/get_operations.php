<?php
/* --------GLOBAL OPERATION INFO SQL--------- */


if (isset($_GET["id"])) {
    try {
        require "model/database_connexion.php";
        $opSql = "SELECT * FROM operation as op WHERE op.compte_ID = :id ORDER BY id DESC";
        $opStmt = $db->prepare($opSql);
        $opStmt->execute(["id" => $_GET["id"]]);
        $operations = $opStmt->fetchAll();
    } catch (PDOException $error) {
        echo "Something went wrong : $error";
    }
}

/* --------RETURN LAST OPERATION INFO SQL--------- */
function getLstOperation($id)
{
    try {
        require "model/database_connexion.php";
        $opSql = "SELECT * FROM operation as op WHERE op.compte_ID = :id ORDER BY id DESC";
        $opStmt = $db->prepare($opSql);
        $opStmt->execute(["id" => $id]);
        $operations = $opStmt->fetchAll();
        // SQL request array must be assigned to variable in order to put them in a string. 
        // I don't know why it will cause an error if i just write them directly.
        if ($opStmt->rowCount() > 0) { // Check using rowCount, if it's equal to 0 that means SQL returned table is empty
            $opType = $operations[0]['type'];
            $opDate = $operations[0]['date_creation'];
            $opDescrpt = $operations[0]['description'];
            $opAmount = $operations[0]['amount'];
            $opStatus = $operations[0]['status'];
            $opPaymentRcv = $operations[0]['payment_receiver'];
            // Since we receive the operations in descending order index 0 is always the last one
            $last_operation = "| $opDate | $opType de $opAmount € $opDescrpt $opPaymentRcv | Statut : $opStatus";
            // TO DO : Make some operation before testing to fill operation table
            return $last_operation;
        } else {
            $last_operation = "Aucune opération effectuée sur ce compte";
            return $last_operation;
        }
    } catch (PDOException $error) {
        echo "Something went wrong : $error";
    }
}
