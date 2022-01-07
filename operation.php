<?php
ob_start();
if (!isset($_SESSION)) {
	session_set_cookie_params(0);
	session_start();
}
?>

<?php
if (!empty($_SESSION["logged_in"]) && $_SESSION["logged_in"]) {
	require_once "./model/entity/accounts.class.php";
	require_once "./model/entity/operation.class.php";
	$account = new Accounts();
	$account->newAccountHandler();
	$operation = new Operation();
	if (isset($_REQUEST["operation_submit"], $_POST["amount"])) {
		if (isset($_POST["acc_selector"])) {
			$operation->operationsHandler($account->getAccount($_SESSION["userID"], $_POST["acc_selector"]), $_POST["amount"]);
		}
	}
	require "./display/bank_accounts_form.php";
	require "./display/operations_form.php";
} else {
	echo "<h2>You must be logged in to acces this page.</h2>";
}
$content = ob_get_clean();
require_once "./layout/template.php";
?>

