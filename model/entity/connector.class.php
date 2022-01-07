
<?php
// TODO ( DONE ) move condition to controller ( login.php )
require_once __DIR__ . "../../Dbh.class.php";

class Connector extends Dbh
{
	public function connectUser(string $usermail, string $userpswrd): ?string
	{
		$db = $this->connectToDatabase();
		$sql = "SELECT mail,passwordHash,id FROM client WHERE mail = :usermail";
		$stmt = $db->prepare($sql);
		$stmt->execute(["usermail" => $usermail]);
		$client = $stmt->fetch(); 
		if ($client){
			if ($this->checkpswrd($userpswrd, $client["passwordHash"])) {
				if (!isset($_SESSION)) {
					session_start();
				}
				$_SESSION["logged_in"] = true;
				$_SESSION["userID"] = $client["id"];
				header("Location: ./acceuil.php");
			}
		} else {
			return "E-mail ou mot de passe érroné";
		}
	}
	private function checkpswrd($pswrd, $pswrdHash): bool
	{
		return $pswrd == trim($pswrdHash) ? true : false;
	}
}
