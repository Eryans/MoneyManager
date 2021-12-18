<?php
/*--------------------ACCOUNTS CREATION-------------------------- */

if (isset($_REQUEST["bk_acc_submit"])) {
    $acc_name = htmlspecialchars(trim($_POST["account"]));
    $acc_owner = htmlspecialchars($_POST["prefix"] . " " . trim($_POST["owner"]));
    $acc_type = htmlspecialchars($_POST["account_type"]);
    $acc_num = rand(100000000000, 999999999999) . "FR" . rand(10, 99);
    $acc_card_num = $acc_type == "card" ? r4() . " " . r4() . " " . r4() . " " . r4() : NULL;
    $acc_ID = $_SESSION["userID"];
    $acc_date = date("Y-m-d");

    try {
        $sqlAdd = " INSERT INTO compte (nom,numero,owner,date_creation_compte,numero_carte,solde,clientID,acc_type)
                    VALUES ('$acc_name','$acc_num','$acc_owner','$acc_date','$acc_card_num',0,'$acc_ID','$acc_type') ";
        $db->exec($sqlAdd);
        unset($_REQUEST);
        echo "Opération réussi !";
        
    } catch (PDOException $error) {
        echo "something went wrong : " . $error;
    }
    $db = null;
}


function r4()
{
    return rand(1000, 9999);
}
/*--------------------ACCOUNTS OPERATION HANDLING-------------------------- */
if (isset($_REQUEST["operation_submit"],$_POST["amount"])){
    var_dump(intval($_POST["acc_selector"]));

    if (isset($_POST["acc_selector"])){
        $sql = "SELECT * FROM compte WHERE id = :accID";
        $stmt = $db->prepare($sql);
        $selectedAcc = intval($_POST["acc_selector"]);
        $stmt->execute(["accID" => $selectedAcc]);
        $currentAccount = $stmt->fetch();
        $amount = $_POST["amount"];
        var_dump($amount);
        $widthdraw_op_sql = "UPDATE compte SET solde = solde - '$amount' WHERE id=:accID";
        
        switch($_POST["operation_type"]){
            case "payment":
                if ($currentAccount["solde"] > 0 + $amount && $amount > 0){
                $sql = $widthdraw_op_sql;
                echo "Opération effectuée !";
            } else {
                echo "Pas assez de fond pour continuer l'opération !";
            }
            break;
            case "withdrawal":
                if ($currentAccount["solde"] > 0 + $amount && $amount > 0){
                    $sql = $widthdraw_op_sql;
                    echo "Opération effectuée !";
                } else {
                    echo "Pas assez de fond pour continuer l'opération !";
                }
            break;
            case "deposit":
                $sql = "UPDATE compte SET solde = solde + '$amount' WHERE id=:accID";
                echo "Opération effectuée !";
            break;
        }
        $stmt = $db->prepare($sql);
        $stmt->execute(["accID" => $_POST["acc_selector"]]);

        /*-------------------- REGISETRING OPERATION -------------------------- */
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
        /*-------------------- CLOSE CONNEXION -------------------------------- */
        $db = null;
        $stmt = null;
        header("Location:./components/acceuil_header_prg.php");
    }
}
