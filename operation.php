<?php 
  if (!isset($_SESSION)){
    session_start();
  }
  include "./layout/header.php" ?>

<?php 
	if (!empty($_SESSION["logged_in"]) && $_SESSION["logged_in"]){
		require_once "./model/entity/accounts.class.php";
		require_once "./model/entity/operation.class.php";
		$account = new Accounts();
		$account->newAccountHandler();
		$operation = new Operation();
		$operation->operationsHandler();
		require "./display/bank_accounts_form.php";
		require "./display/operations_form.php";
	} else {
		echo "<h2>You must be logged in to acces this page.</h2>";
	} 
?>

<?php include "./layout/footer.php"  ?>
