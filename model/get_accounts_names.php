<?php
require "./model/database_connexion.php";
$sql = "SELECT nom,id FROM compte WHERE clientID = :id";
$stmt = $db->prepare($sql);
$stmt->execute(["id" => $_SESSION["userID"]]);
$accounts = $stmt->fetchAll();
foreach ($accounts as $act) {
	echo "<option value=" . $act['id'] . ">" . $act['nom'] . "</option>";
}
$db = null;
$stmt = null;
