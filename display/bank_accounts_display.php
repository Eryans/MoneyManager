<?php
require "display/cards.php";

if (!isset($_SESSION)) {
	session_start();
}

/*--------------------ACCOUNTS DISPLAY-------------------------- */

require_once "./model/entity/accounts.class.php";
$accountManager = new Accounts();
$accounts = $accountManager->getAccounts();
$fName = $accounts[0]["prenom"];
$lName = $accounts[0]["nom"];


echo
"
	<div class='container-fluid'>
		<h2>
			Bonjour <br>" . $fName . " " . $lName . "
		</h2>";
echo
"		<section>
			<h2>Comptes :</h2>
			<ul class='list-group d-flex flex-row flex-wrap gap-3'>";
for ($i = 0; $i < count($accounts); $i++) {
	echo "<li style='list-style-type: none;'>";

	/* --------LAST OPERATION SQL--------- */
    require_once "./model/entity/operation.class.php";
	$operations = new Operation();
    $last_operation = $operations->getLastOperation($accounts[$i]["cID"]);

	$card = new Card(true, $accounts[$i]["cID"], $accounts[$i]["cNom"], $accounts[$i]["numero"],
	$accounts[$i]["owner"], $accounts[$i]["solde"], $last_operation, $accounts[$i]["date_creation_compte"]);
	$card->show_card();
	echo "</li>";
}
echo "		</ul>
		</section>
	</div>";
$db = null;
$stmt = null;
