<?php
	$pageTitle = (isset($pageTitle)) ? $pageTitle:"Linkify";
	$error = $_SESSION["error"] ?? "";
	$message = $_SESSION["message"] ?? "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $pageTitle; ?></title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/10up-sanitize.css/4.1.0/sanitize.min.css">
	<link rel="stylesheet" href="/assets/styles/main.css">
</head>
<body>
	<div class="page">
		<header>
			<h1><a href="index.php">Linkify</a></h1>

			<?php if (!checkLogin($db)) { ?>
				<nav class="auth">
					<a href="#" class="menuLink">Log in</a>
				</nav>
			<?php } else { ?>
				<nav class="menuNav">
					<a href="#" class="menuLink">Menu</a>
				</nav>

			<?php }; ?>
		</header>
