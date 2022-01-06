
<?php include "./layout/header.php" ?>

<?php
require "./display/connexion_form.php";
require "./model/entity/connector.class.php";
$connec = new Connector();

if (isset($_POST["login_submit"])) {
    if (!empty($_POST["usermail"]) && !empty($_POST["password"])) {
        $usermail = filter_var($_POST["usermail"], FILTER_VALIDATE_EMAIL);
        $userpswrd = htmlspecialchars($_POST["password"]);
        $connec->connectUser($usermail,$userpswrd);
    }
}
?>

<?php include "./layout/footer.php"; ?>