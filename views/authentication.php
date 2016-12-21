<?php
require __DIR__.'/../app/auth/register.php';
require __DIR__.'/../app/auth/login.php';

require __DIR__."/partials/header.php";
$posts = getPosts($db);
?>

	<div class="content">
		<?php if ($posts) {
			foreach ($posts as $post) { ?>
				<div class="post">
					<?php require __DIR__."/partials/post.block.php";
						// check if post has comments
						$comments = getComments($db, $post["id"]);
						if ($comments) {
							require __DIR__."/partials/comment.block.php";
						}
					?>
				</div>
		<?php }} ?>
		<p>Put top ten most voted links on start page</p>
	</div>
</div> <!-- end page -->

<!-- forms slide in -->
<div class="menuSlide">

	<div class="forms">

		<div class="loginWrap">
			<h3>Log in</h3>
			<form action="index.php" method="post" class="login">
				<div class="authMessage"><?php if(isset($loginMessage)) echo $loginMessage; ?></div>
				<input type="text" name="username" placeholder="Email or username" value="<?=isset($_POST["username"]) ? $_POST["username"] : ''; ?>">
				<input type="password" name="password" placeholder="Password">
				<input type="checkbox" name="remember" checked><label for="remember">Remember me</label>
				<input type="submit" name="loginSubmit" value="Log in">
			</form>
		</div>

		<div class="registerWrap">
			<h3>Register</h3>
			<form action="index.php" method="post" class="register">
				<div class="authMessage"><?php if(isset($regMessage)) echo $regMessage; ?></div>
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
