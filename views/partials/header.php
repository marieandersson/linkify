<?php
	$pageTitle = (isset($pageTitle)) ? $pageTitle:"Linkify";
	$error = $_SESSION["error"] ?? "";
	$message = $_SESSION["message"] ?? "";
	if (checkLogin($db)) {
		$user = getUserInfo($db);
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $pageTitle; ?></title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/10up-sanitize.css/4.1.0/sanitize.min.css">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Syncopate">
	<link rel="stylesheet" href="/assets/styles/main.css">
</head>
<body>
	<div class="acceptCookies">
		<p>This website uses <a class="cookieLink" href="https://cookielaw.org/the-cookie-law" title="Read more about the cookie law">cookies</a>
			to give you the best experience possible.</p>
		<button class="cookieButton">Accept</button>
	</div>
	<div class="page">
		<header>
			<div class="leftHeader">
				<img src="/assets/images/logo.png"/>
				<h1><a href="/index.php">Linkify</a></h1>

			</div>

			<?php if (!checkLogin($db)) { ?>
			<nav class="authNav">
				<div class="menuLink">
					<img src="/assets/images/menuicon.png"/>
				</div>
			</nav>
			<?php } else { ?>
			<nav class="menuNav">
				<?php if ($posts) {
				if ($pageTitle != "Linkify - Settings" && $pageTitle != "Linkify - Profile") { ?>
				<div class="sortPosts">
				<form action="/index.php" method="post">
					<input type="submit" name="byDate" value="New">
					<input type="submit" name="byPop" value="Popular">
				</form>
				</div>
				<?php }} ?>
				<div class="profileLink">
					<a href="/profile.page.php/?user=<?=$_SESSION["login"]["username"]?>">
						<?php if ($user["avatar"] !== NULL) {  ?>
						<img src="/assets/images/users/<?=$user["id"]?>/<?=$user["avatar"]?>" />
						<?php } else { ?>
						<img src="/assets/images/profileicon.png" />
						<?php } ?>
					</a>
				</div>
				<div class="menuLink">
					<img src="/assets/images/menuicon.png"/>
				</div>
			</nav>
			<?php }; ?>
		</header>
