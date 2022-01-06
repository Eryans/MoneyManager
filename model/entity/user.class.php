<?php
require_once __DIR__ . "../../Dbh.class.php";
class User extends Dbh
{
    public function getUserNames(): ?string
    {
        $db = $this->connectToDatabase();
        if (!isset($_SESSION)) {
            session_set_cookie_params(0);
            session_start();
        }
        if (!empty($_SESSION["logged_in"]) && $_SESSION["logged_in"]) {
            $sql = "SELECT prenom,nom FROM client WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->execute(["id" => $_SESSION["userID"]]);
            $client = $stmt->fetch();
            $name = $client["prenom"] . " " . $client["nom"];
            return $name;
        }
        return null;
    }
    public function getUserInfo(): ?array
    {
        $db = $this->connectToDatabase();
        $sql = "SELECT * FROM client WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->execute(["id" => $_SESSION["userID"]]);
        $userInfo = $stmt->fetch();
        return $userInfo;
    }
}
