
<?php include "./layout/header.php" ?>

<p>Test username and password is "thomgo" - "12345"</p>
<form action="" method="POST">
	<label for="username">Username : </label>
	<input type="text" name="username">

	<label for="password">Password :</label>
	<input type="text" name="password">
	<input type="submit" name="submit" value="submit">
</form>

<?php 
	require "data/passwords.php";
	$logins = getLogin();

	if (!empty($_POST) && isset($_POST["username"],$_POST["password"])){
		foreach($logins as $key => $value)	
		{
			if($logins[$key]["username"] == $_POST["username"] && $logins[$key]["password"] == $_POST["password"]){
				//print_r("haha login system goes brrrrrr");
				header("Location:acceuil.php");
			}
		}
	}
?>

<?php include "./layout/footer.php" ?>