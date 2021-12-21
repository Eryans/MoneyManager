<?php 
  if (!isset($_SESSION)){
    session_start();
  }
  include "./layout/header.php" ?>

<?php 
	if (!empty($_SESSION["logged_in"]) && $_SESSION["logged_in"]){
		require "./components/bank_account_creation.php";
		require "./components/bank_accounts_operation.php";
		require "./display/bank_accounts_form.php";
	} else {
		echo "<h2>You must be logged in to acces this page.</h2>";
	} 
?>

<?php include "./layout/footer.php"  ?>
