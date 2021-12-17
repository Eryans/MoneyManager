<?php
/*--------------------------------TODO : BREAK FILE IN MULTIPLE COMPONENT ------------------------------------------ */
if (!isset($_SESSION)) {
    session_set_cookie_params(0);
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
    require_once "components/get_operations.php";
    $last_operation = getLstOperation($_GET["id"]);

    if ($stmt->rowCount() > 0) {
        // Account info
        $card = new Card(FALSE, $account["id"], $account["cNom"], $account["numero"], $account["nom"] . " " . $account["prenom"], $account["solde"], $last_operation, $account["date_creation_compte"]);
        $card->show_card();
        // Operation list ( trying another syntax instead of using echo everywhere btw )
        if ($opStmt->rowCount() > 0) {
?>
            <div class="overflow-auto d-flex justify-content-center">
                <table id="operation_list">
                    <thead>
                        <tr>
                            <th colspan="12">Liste des opérations</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="5"><strong>Date</strong></td>
                            <td><strong>Description</strong></td>
                            <td><strong>Montant</strong></td>
                            <td><strong>Compte Emetteur/Receveur</strong></td>
                        </tr>
                        <?php
                        for ($i = 0; $i < $opStmt->rowCount(); $i++) {
                            $opType = $operations[$i]['type'];
                            $opDate = $operations[$i]['date_creation'];
                            $opDescrpt = $operations[$i]['description'];
                            $opAmount = $operations[$i]['amount'];
                            $opStatus = $operations[$i]['status'];
                            $opPaymentRcv = $operations[$i]['payment_receiver'];
                        ?>
                            <tr>
                                <?php
                                echo "
                            <td colspan='5'>$opDate</td>
                            <td>$opType $opDescrpt</td>
                            <td>$opAmount</td>
                            <td>$opPaymentRcv</td>";
                                ?>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
<?php
        }
    } else {
        echo "<h2>ERROR TRYING TO ACCESS ACCOUNT</h2>";
    }
} else {
    echo "<h2>You must be logged in to acces this page.</h2>";
}


?>

<?php include "layout/footer.php" ?>