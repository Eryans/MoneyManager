<?php
/*--------------------------------TODO : BREAK FILE IN MULTIPLE COMPONENT ------------------------------------------ */
if (!isset($_SESSION)) {
    session_set_cookie_params(0);
    session_start();
}
ob_start();

if (!empty($_SESSION["logged_in"]) && $_SESSION["logged_in"]) {

    
    require_once "display/cards.class.php";
    require_once "model/entity/accounts.class.php";
    require_once "model/entity/operation.class.php";
    $accountMngr = new Accounts();
    $account = $accountMngr->getAccount($_SESSION["userID"],$_GET["id"]);
    $operationsMng = new Operation();
    $last_operation = $operationsMng->getLastOperation($_GET["id"]);
    $operations = $operationsMng->getOperations();

    if (count($account) > 0) {
        // Account info
        $card = new Card(["_isNotDetail" => false, "_id" => htmlspecialchars($_GET["id"]),"_name" => $account["cNom"],"_cardNum" => $account["numero"],
        "_owner" => $account["owner"],"_amount" => $account["solde"],"_lastOp" => $last_operation, "_date_creation" => $account["date_creation_compte"],"_type" => $account["acc_type"]]);
        $card->show_card();
        // Operation list ( trying another syntax instead of using echo everywhere )
        // Make code below into a separated display file
        if (count($operations) > 0) {
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
                        for ($i = 0; $i < count($operations); $i++) {
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
$content = ob_get_clean();
require_once "./layout/template.php";
?>
