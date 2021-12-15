<?php
    if(!isset($_SESSION)) 
        { 
            session_start(); 
        }
    $name = "";
    $log_in_out = false;
    if (!empty($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true) {
        require "./model/model.php";
        $sql = "SELECT prenom,nom FROM client WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->execute(["id" => $_SESSION["userID"]]);
        $client = $stmt->fetch();
        $name = $client["prenom"] . " " . $client["nom"];
        $log_in_out = true;
    }
?>