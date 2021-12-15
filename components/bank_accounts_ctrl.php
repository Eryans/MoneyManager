<?php
require "data/accounts.php";
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
	$card = new Card(true, $client[$i]["cNom"], $client[$i]["numero"], $client[$i]["prenom"] . " " . $client[$i]["nom"], $client[$i]["solde"], "lorem ipsum");
	$card->show_card();
	echo "</li>";
}
echo "</ul>";
echo "</div>";

/*--------------------ACCOUNTS CREATION FORM-------------------------- */

if (isset($_REQUEST["bk_acc_submit"])){
	$acc_name = htmlspecialchars(trim($_POST["account"]));
	$acc_owner = htmlspecialchars($_POST["prefix"] . " " . trim($_POST["owner"]));
	$acc_type = htmlspecialchars($_POST["account_type"]);
	$acc_num = rand(100000000000, 999999999999) . "FR" . rand(10, 99);
	$acc_card_num = $acc_type == "card" ? r4() . " " . r4() . " " . r4() . " " . r4() : NULL;
	$acc_ID = $_SESSION["userID"];
	$acc_date = date("Y-m-d");

	$sqlAdd = " INSERT INTO compte (nom,numero,date_creation_compte,numero_carte,solde,clientID,acc_type)
				VALUES ('$acc_name','$acc_num','$acc_date','$acc_card_num',0,'$acc_ID','$acc_type') ";
	$db->exec($sqlAdd);
	unset($_REQUEST);
}


function r4()
{
	return rand(1000, 9999);
}
