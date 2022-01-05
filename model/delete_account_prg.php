<h1>DELETING ACCOUNT TEST</h1>
<?php
require_once "entity/accounts.class.php";
require_once "entity/operation.class.php";
$operationMngr = new Operation();
$accountMngr = new Accounts();
$operationMngr->deleteOperation($_GET["id"]);
$accountMngr->deleteAccount($_GET["id"]);
header("Location:../acceuil.php?message=Opération réussie");
?>