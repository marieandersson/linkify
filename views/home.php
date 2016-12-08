<?php require __DIR__."/partials/header.php"; ?>

<p>Welcome <?= $_SESSION["login"]["username"]?></p>

<a href="app/auth/logout.php">Log out</a>

<?php require __DIR__."/partials/footer.php"; ?>
