<h1>DELETING ACCOUNT</h1>
<?php
require_once __DIR__."/entity/accounts.class.php";
require_once __DIR__."/entity/operation.class.php";
$operationMngr = new Operation();
$accountMngr = new Accounts();
$operationMngr->deleteOperation($_GET["id"]);
$accountMngr->deleteAccount($_GET["id"]);
header("Location:../acceuil.php?message=Opération réussie");
?>