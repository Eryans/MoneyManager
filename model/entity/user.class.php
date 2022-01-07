<?php
require_once __DIR__ . "../../Dbh.class.php";
class User extends Dbh
{
    public function getUserNames(): ?array
    {
        $db = $this->connectToDatabase();
        try{
            $sql = "SELECT prenom,nom FROM client WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->execute(["id" => $_SESSION["userID"]]);
            return $stmt->fetch();
        }catch(PDOException $e){
            die("something went wrong : ".$e);
        }
        return null;
    }
    public function getUserInfo(): ?array
    {
        try {
            $db = $this->connectToDatabase();
            $sql = "SELECT * FROM client WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->execute(["id" => $_SESSION["userID"]]);
            $userInfo = $stmt->fetch();
            return $userInfo;
        } catch (PDOException $e) {
            die("Something went wrong : " . $e);
        }
    }
}
