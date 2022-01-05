<?php
require_once "model/Dbh.class.php";
class Operation extends Dbh
{
    function operationsHandler()
    {
        /*-------------------- OPERATION HANDLING-------------------------- */
        if (isset($_REQUEST["operation_submit"], $_POST["amount"])) {
            $db = $this->connectToDatabase();
            if (isset($_POST["acc_selector"])) {
                $sql = "SELECT * FROM compte WHERE id = :accID";
                $stmt = $db->prepare($sql);
                $selectedAcc = intval($_POST["acc_selector"]);
                $stmt->execute(["accID" => $selectedAcc]);
                $currentAccount = $stmt->fetch();
                $amount = $_POST["amount"];

                $db->beginTransaction();
                try {
                    switch ($_POST["operation_type"]) {
                        case "withdrawal":
                        case "payment":
                            if ($currentAccount["solde"] >= $amount && $amount > 0) {
                                $sql = "UPDATE compte SET solde = solde - '$amount' WHERE id=:accID";
                            } else {
                                echo "<h2 class='text-danger'>Pas assez de fond pour continuer l'opération !</h2>";
                            }
                            break;
                        case "deposit":
                            $sql = "UPDATE compte SET solde = solde + '$amount' WHERE id=:accID";
                            break;
                    }
                    $stmt = $db->prepare($sql);
                    $stmt->execute(["accID" => $_POST["acc_selector"]]);
                    $db->commit();
                    header("Location:./operation_prg.php");
                } catch (PDOException $e) {
                    $db->rollBack();
                    die("Something went wrong :" . $e);
                }

                /*-------------------- REGISTERING TRANSACTION OPERATION -------------------------- */
                $db->beginTransaction();
                try {
                    $accountID = $currentAccount["id"];
                    $operationDescpt = htmlspecialchars($_POST["op_description"]);
                    $operationDate = date("Y-m-d");
                    $operationType = htmlspecialchars($_POST["operation_type"]);
                    $operationAmount = htmlspecialchars($amount);
                    $operationStatus = "Terminé";
                    $operationClientID = $currentAccount["clientID"];
                    $operationReceiver = htmlspecialchars($_POST["receiving_account"]);
                    $sql = "INSERT INTO operation 
                VALUES(DEFAULT,'$accountID','$operationDescpt','$operationDate','$operationType','$operationAmount','$operationStatus','$operationClientID','$operationReceiver')";
                    $stmt = $db->prepare($sql);
                    $stmt->execute();
                    $db->commit();
                } catch (PDOException $e) {
                    $db->rollBack();
                    die("Something went wrong :" . $e);
                }

                /*-------------------- CLOSE CONNEXION -------------------------------- */
                $db = null;
                $stmt = null;
            }
        }
    }

    public function getOperations()
    {
        $db = $this->connectToDatabase();
        if (isset($_GET["id"])) {
            try {
                $opSql = "SELECT * FROM operation as op WHERE op.compte_ID = :id ORDER BY id DESC";
                $opStmt = $db->prepare($opSql);
                $opStmt->execute(["id" => $_GET["id"]]);
                $operations = $opStmt->fetchAll();
                return $operations;
            } catch (PDOException $error) {
                echo "Something went wrong : $error";
            }
        }
    }

    /* --------RETURN LAST OPERATION INFO SQL--------- */
    public function getLastOperation($id)
    {
        $db = $this->connectToDatabase();
        try {
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
}
