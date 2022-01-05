<h1>DELETING ACCOUNT</h1>
<?php
require "../model/database_connexion.php";
try {
    // TODO : (DONE ) Write 2 SQL statement. First delete childs elements ( operations )  Seconde remove the Parent ( current account ) 
    $sql = "DELETE FROM operation WHERE compte_ID=:id"; // <----- Child removal stmt
    $stmt = $db->prepare($sql);
    $stmt->execute(["id" => htmlspecialchars($_GET['id'])]);
    $sql = "DELETE FROM compte WHERE id=:id"; // <----- Parent removal stmt
    $stmt = $db->prepare($sql);
    $stmt->execute(["id" => htmlspecialchars($_GET['id'])]);
    header("Location:../acceuil.php?message=Opération réussie");
} catch (PDOException $e) {
    echo "Something went wrong when trying to delete accoun : $e";
}
?>