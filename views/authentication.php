<?php
require __DIR__."/partials/header.php";
$posts = getPosts($db);
?>

	<div class="content">
		<div class="displayPosts">
			<?php if ($posts) {
				foreach ($posts as $post) { ?>
					<div class="post">
						<?php require __DIR__."/partials/post.block.php" ?>
					</div>
			<?php }} ?>
		</div>
	</div>
</div> <!-- end page -->

<!-- forms slide in -->
<div class="menuSlide">

	<p class="menuLink close">X</p>

	<div class="forms">

		<div class="loginWrap">
			<h3>Log in</h3>
			<form action="app/auth/login.php" method="post" class="login">
				<?php if ($error) { ?>
					<div class="error">
							<?= $error; ?>
					</div>
				<?php unset($_SESSION["error"]); } ?>
				<input type="text" name="username" placeholder="Email or username" value="<?=isset($_POST["username"]) ? $_POST["username"] : ''; ?>">
				<input type="password" name="password" placeholder="Password">
				<input type="checkbox" name="remember" checked><label for="remember">Remember me</label>
				<input type="submit" name="loginSubmit" value="Log in">
			</form>
		</div>

		<div class="registerWrap">
			<h3>Register</h3>
			<form action="app/auth/register.php" method="post" class="register">
				<?php if ($error) { ?>
					<div class="error">
							<?= $error; ?>
						</div>
				<?php unset($_SESSION["error"]); } ?>
				<input type="text" name="fullName" placeholder="Full name" value="<?=isset($_POST["fullName"]) ? $_POST["fullName"] : ''; ?>">
	      <input type="text" name="usernameReg" placeholder="Username" value="<?=isset($_POST["usernameReg"]) ? $_POST["usernameReg"] : ''; ?>">
				<input type="email" name="emailReg" placeholder="Email" value="<?=isset($_POST["emailReg"]) ? $_POST["emailReg"] : ''; ?>">
				<input type="password" name="passwordReg" placeholder="Password">
				<input type="checkbox" name="terms"><label for="terms">Accept terms</label>
				<input type="submit" name="registerSubmit" value="Register">
			</form>
		</div>

	</div>

</div>


<?php require __DIR__."/partials/footer.php"; ?>
