<?php
require_once "./model/Dbh.class.php";
class Accounts extends Dbh
{
    function getAccounts()
    {
        $db = $this->connectToDatabase();
        $db->beginTransaction();
        $sql = "SELECT *,cp.id as cID, cp.nom as cNom FROM compte as cp INNER JOIN client as cl ON cp.clientID = cl.id WHERE clientID = :id";
        $stmt = $db->prepare($sql);
        $stmt->execute(["id" => $_SESSION["userID"]]);
        $db->commit();
        return $stmt->fetchAll();
    }

    public function newAccountHandler()
    {
        $db = $this->connectToDatabase();
        if (isset($_REQUEST["bk_acc_submit"])) {
            $acc_name = htmlspecialchars(trim($_POST["account"]));
            $acc_owner = htmlspecialchars($_POST["prefix"] . " " . trim($_POST["owner"]));
            $acc_type = htmlspecialchars($_POST["account_type"]);
            $acc_num = rand(100000000000, 999999999999) . "FR" . rand(10, 99);
            $acc_card_num = $acc_type == "card" ? $this->r4() . " " . $this->r4() . " " . $this->r4() . " " . $this->r4() : NULL;
            $acc_ID = $_SESSION["userID"];
            $acc_date = date("Y-m-d");

            $db->beginTransaction();
            try {
                $sqlAdd = "INSERT INTO compte (nom,numero,owner,date_creation_compte,numero_carte,solde,clientID,acc_type)
                    VALUES ('$acc_name','$acc_num','$acc_owner','$acc_date','$acc_card_num',0,'$acc_ID','$acc_type') ";
                $db->exec($sqlAdd);
                unset($_REQUEST);
                $db->commit();
                echo "Opération réussi !";
            } catch (PDOException $error) {
                $db->rollBack();
                echo "something went wrong : " . $error;
            }
            $db = null;
        }
    }
    private function r4()
    {
        return rand(1000, 9999);
    }

    public function getAccountsNames()
    {
        $db = $this->connectToDatabase();
        $sql = "SELECT nom,id FROM compte WHERE clientID = :id";
        $stmt = $db->prepare($sql);
        $stmt->execute(["id" => $_SESSION["userID"]]);
        $accounts = $stmt->fetchAll();
        return $accounts;
    }

    public function deleteAccount(int $id){
        try {
            $db = $this->connectToDatabase();
            $db->beginTransaction();
            $sql = "DELETE FROM compte WHERE id=:id"; // <----- Parent removal stmt
            $stmt = $db->prepare($sql);
            $stmt->execute(["id" => htmlspecialchars($id)]);
            $db->commit();
        } catch (PDOException $e) {
            $db->rollBack();
            echo "Something went wrong when trying to delete account : $e";
        }
    }
}
