<h1>DELETING ACCOUNT</h1>
<?php
require_once __DIR__."/model/entity/accounts.class.php";
require_once __DIR__."/model/entity/operation.class.php";
$operationMngr = new Operation();
$accountMngr = new Accounts();
$operationMngr->deleteOperation(htmlspecialchars($_GET["id"]));
$accountMngr->deleteAccount(htmlspecialchars($_GET["id"]));
header("Location:acceuil.php?message=Opération réussie");
?>