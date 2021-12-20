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