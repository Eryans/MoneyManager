<?php
    require "database_connexion.php";
    $sql = "SELECT *,cp.id as cID, cp.nom as cNom FROM compte as cp INNER JOIN client as cl ON cp.clientID = cl.id WHERE clientID = :id";
    $stmt = $db->prepare($sql);
    $stmt->execute(["id" => $_SESSION["userID"]]);
    $client = $stmt->fetchAll();
?>