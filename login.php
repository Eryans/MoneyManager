
<?php ob_start();
require "./display/connexion_form.php";
require "./model/entity/connector.class.php";
$connec = new Connector();

if (isset($_POST["login_submit"])) {
    if (!empty($_POST["usermail"]) && !empty($_POST["password"])) {
        $usermail = filter_var($_POST["usermail"], FILTER_VALIDATE_EMAIL, "Error");
        $userpswrd = htmlspecialchars($_POST["password"]);
        $connexionMsg = $connec->connectUser(htmlspecialchars($usermail), $userpswrd);
    }
    echo "<p class='text-danger text-center h3'>" . $connexionMsg ?? "" . "</p>";
}
$content = ob_get_clean();
require_once "./layout/template.php";
?>
