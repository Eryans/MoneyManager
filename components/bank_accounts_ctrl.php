<?php
require "components/cards.php";
require "model/model.php";

if (!isset($_SESSION)) {
	session_start();
}

/*--------------------ACCOUNTS DISPLAY-------------------------- */

$sql = "SELECT *,cp.id as cID, cp.nom as cNom FROM compte as cp INNER JOIN client as cl ON cp.clientID = cl.id WHERE clientID = :id";
$stmt = $db->prepare($sql);
$stmt->execute(["id" => $_SESSION["userID"]]);
$client = $stmt->fetchAll();

$fName = $client[0]["prenom"];
$lName = $client[0]["nom"];


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
for ($i = 0; $i < $stmt->rowCount(); $i++) {
	echo "<li style='list-style-type: none;'>";

	/* --------LAST OPERATION SQL--------- */
    require_once "get_operations.php";
    $last_operation = getLstOperation($client[$i]["cID"]);

	$card = new Card(true, $client[$i]["cID"], $client[$i]["cNom"], $client[$i]["numero"],
	$client[$i]["prenom"] . " " . $client[$i]["nom"], $client[$i]["solde"], $last_operation, $client[$i]["date_creation_compte"]);
	$card->show_card();
	echo "</li>";
}
echo "		</ul>
		</section>
	</div>";
$db = null;
$stmt = null;
