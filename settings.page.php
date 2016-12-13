<?php
require __DIR__."/autoload.php";
require __DIR__."/app/settings.php";
$pageTitle = "Settings";
require __DIR__."/views/partials/header.php";
$displayUserInfo = getUserInfo($db);
?>

	<div class="content">
		<h2>Account settings</h2>

		<form action="settings.page.php" method="post" class="settingsForm" enctype="multipart/form-data">
			<div class="updateMessage"><?php if(isset($updateErrorMessage)) echo $updateErrorMessage; ?></div>
			<div class="change">
				<h3>Change username</h3>
				<label for="editUsername">Username</label>
				<input type="text" name="editUsername" value="<?=$displayUserInfo['username']?>">
			</div>

			<div class="change">
				<h3>Change email</h3>
				<label for="editEmail">Email</label>
				<input type="text" name="editEmail" value="<?=$displayUserInfo['email']?>">
			</div>

			<div class="change">
				<h3>Change name</h3>
				<label for="editFullName">Name</label>
				<input type="text" name="editFullName" value="<?=$displayUserInfo['name']?>">
			</div>


			<div class="change">
				<h3>Change password</h3>
				<label for="editPassword">New password</label>
				<input type="password" name="editPassword">

				<label for="repeatPassword">Repeat password</label>
				<input type="password" name="repeatPassword">
			</div>

			<div class="change">
				<h3>About</h3>
					<textarea name="about"><?= $displayUserInfo["about"]?></textarea>
			</div>

			<div class="change">
				<h3>Profile picture</h3>
				<input type="file" name="avatar" accept="image/png, image/jpeg">
				<div class="placeholderAvatar"></div>
			</div>

			<hr/>

			<div class="change">
				<label for="saveWithPassword">Password</label><input type="password" name="saveWithPassword">
				<input type="submit" name="saveChanges" value="Save changes">
			</div>

		</form>
	</div>

</div> <!-- end page -->
<?php
require __DIR__."/views/partials/footer.php";
require __DIR__."/views/partials/navigation.php";
?>
