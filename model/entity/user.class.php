<?php
require_once __DIR__ . "../../Dbh.class.php";
class User extends Dbh
{
    private int $id;

    public function __construct(?int $id)
    {
        $this->id = $id;
    }
    public function getUserNames(): ?array
    {
        $db = $this->connectToDatabase();
        try {
            $sql = "SELECT prenom,nom FROM client WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->execute(["id" => $this->id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            die("something went wrong : " . $e);
        }
        return null;
    }
    public function getUserInfo(): ?array
    {
        $db = $this->connectToDatabase();
        try {
            $sql = "SELECT * FROM client WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->execute(["id" => $this->id]);
            $userInfo = $stmt->fetch();
            return $userInfo;
        } catch (PDOException $e) {
            die("Something went wrong : " . $e);
        }
    }
}
