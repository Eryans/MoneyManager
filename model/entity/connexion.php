
<?php
	$error_msg = "";
	$usermail = $userpswrd = "";

	if(isset($_POST["login_submit"])){
		if (!empty($_POST["usermail"]) && !empty($_POST["password"])){
			$usermail = filter_var($_POST["usermail"],FILTER_VALIDATE_EMAIL);
			$userpswrd = $_POST["password"];
		}

		if (!empty($usermail)){
			require "./model/database_connexion.php";
			$sql = "SELECT mail,passwordHash,id FROM client WHERE mail = :usermail";
			$stmt = $db->prepare($sql);
			$stmt->execute(["usermail" => $usermail]);
			$client = $stmt->fetch();
			if (checkpswrd($userpswrd, $client["passwordHash"])){
				session_start();
				$_SESSION["logged_in"] = true;
				$_SESSION["userID"] = $client["id"];
				header("Location: ./acceuil.php");
			}
		} 
	}
	if (!empty($_SESSION)) {var_dump($_SESSION["logged_in"],$_SESSION["userID"]);}
	if ($error_msg) {echo "<h2>".$error_msg."</h2>";}

	function checkpswrd($pswrd,$pswrdHash){
		return $pswrd == trim($pswrdHash) ? true : false; 
	}
	$db = null;
	$stmt = null;
?>
