
<?php include "./layout/header.php" ?>

<?php require "./display/connexion_form.php";
require "./model/entity/connexion.php";
$connec = new Connector();
$connec->connectUser();
?>

<?php include "./layout/footer.php"; ?>