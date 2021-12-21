<?php
require "./model/database_connexion.php";
/*--------------------ACCOUNTS OPERATION HANDLING-------------------------- */
if (isset($_REQUEST["operation_submit"],$_POST["amount"])){

    if (isset($_POST["acc_selector"])){
        $opSucces = false;
        $sql = "SELECT * FROM compte WHERE id = :accID";
        $stmt = $db->prepare($sql);
        $selectedAcc = intval($_POST["acc_selector"]);
        $stmt->execute(["accID" => $selectedAcc]);
        $currentAccount = $stmt->fetch();
        $amount = $_POST["amount"];
        
        switch($_POST["operation_type"]){
            case "withdrawal":
            case "payment":
                if ($currentAccount["solde"] >= $amount && $amount > 0){
                    $sql = "UPDATE compte SET solde = solde - '$amount' WHERE id=:accID";
                    $opSucces = true;
                } else {
                    echo "<h2 class='text-danger'>Pas assez de fond pour continuer l'opération !</h2>";
                }
            break;
            case "deposit":
                $sql = "UPDATE compte SET solde = solde + '$amount' WHERE id=:accID";
                $opSucces = true;
            break;
            
        }

        if ($opSucces){
            $stmt = $db->prepare($sql);
            $stmt->execute(["accID" => $_POST["acc_selector"]]);
            header("Location:./components/operation_prg.php");
        }

        /*-------------------- REGISTERING TRANSACTION OPERATION -------------------------- */
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
    }
}
