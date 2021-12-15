<?php
require "components/cards.php";
require "model/model.php";

if (!isset($_SESSION)) {
	session_start();
}

/*--------------------ACCOUNTS DISPLAY-------------------------- */

$sql = "SELECT *,cp.nom as cNom FROM compte as cp INNER JOIN client as cl ON cp.clientID = cl.id WHERE clientID = :id";
$stmt = $db->prepare($sql);
$stmt->execute(["id" => $_SESSION["userID"]]);
$client = $stmt->fetchAll();

$fName = $client[0]["prenom"];
$lName = $client[0]["nom"];

echo
"<h2>
	Bonjour <br>" . $fName . " " . $lName . "
</h2>";

echo
"<div>
	<h2>Comptes :</h2>
<ul class='list-group'>";
for ($i = 0; $i < $stmt->rowCount(); $i++) {
	echo "<li style='list-style-type: none;'>";
	$card = new Card(true, $client[$i]["cNom"], $client[$i]["numero"], $client[$i]["prenom"] . " " . $client[$i]["nom"], $client[$i]["solde"], "lorem ipsum", $client[$i]["date_creation_compte"]);
	$card->show_card();
	echo "</li>";
}
echo "</ul>";
echo "</div>";
$db = null;
$stmt = null;	

