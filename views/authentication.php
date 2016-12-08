<?php
require __DIR__.'/../app/auth/register.php';
require __DIR__.'/../app/auth/login.php';
?>

<div class="forms">

	<div class="loginWrap">
		<form action="index.php" method="post" class="login">
			<div class="message"><?php if(isset($loginMessage)) echo $loginMessage; ?></div>
			<input type="text" name="username" placeholder="Email or username">
			<input type="password" name="password" placeholder="Password">
			<input type="submit" name="loginSubmit" value="Log in">
		</form>
	</div>

	<div class="registerWrap">
		<form action="index.php" method="post" class="register">
			<div class="message"><?php if(isset($regMessage)) echo $regMessage; ?></div>
			<input type="text" name="fullName" placeholder="Full name">
      <input type="text" name="username" placeholder="Username">
			<input type="email" name="emailReg" placeholder="Email">
			<input type="password" name="passwordReg" placeholder="Password">
			<input type="checkbox" name="terms"><label for="terms">Accept terms</label>
			<input type="submit" name="registerSubmit" value="Register">
		</form>
	</div>

</div>
