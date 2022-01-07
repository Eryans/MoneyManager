<?php
if (!isset($_SESSION)) {
	session_set_cookie_params(0);
	session_start();
} ?>
<!doctype html>
<html class="no-js" lang="en">

<head>
	<meta charset="utf-8">
	<title>Money Manager</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta property="og:title" content="">
	<meta property="og:type" content="">
	<meta property="og:url" content="">
	<meta property="og:image" content="">

	<link rel="manifest" href="site.webmanifest">
	<link rel="apple-touch-icon" href="icon.png">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<!-- Place favicon.ico in the root directory -->

	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/main.css">

	<meta name="theme-color" content="#fafafa">
</head>

<body>

	<header class="bg-dark text-white text-center ">
		<h1 class="m-0 p-2">Money Manager</h1>
		<?php
		require "./model/entity/user.class.php";
		$user = new User();
		$namesResult = "";
		if (!empty($_SESSION["logged_in"]) && $_SESSION["logged_in"]) {
			$namesResult = $user->getUserNames();
		}
		$names = $namesResult ? $namesResult["prenom"] . " " . $namesResult["nom"] : "";
		?>
		<span class="d-flex gap-4 justify-content-end">
			<?php echo $names;
			echo (!empty($_SESSION["logged_in"]) && $_SESSION["logged_in"]) ? "<button onclick='logOut()'> Log out </button>" : "<button onclick='signIn()'> Sign in </button>";
			?>
		</span>
	</header>
	<?php include "./layout/navbar.php" ?>

	<script>
		// ------------------------------------ SIGN IN/ LOG OUT -------------------------------------------
		function logOut() {
			document.location.href = '<?php echo "./logout.php"; ?>';
		}

		function signIn() {
			document.location.href = '<?php echo "./login.php"; ?>';
		}
	</script>

	<main class="container-fluid d-flex justify-content-center align-content-center flex-column flex-lg-wrap flex-lg-rowp-3 bg-info">