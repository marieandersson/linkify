<?php
require __DIR__."/autoload.php";
$pageTitle = "Linkify - Settings";
$posts = NULL;
require __DIR__."/views/partials/header.php";
?>

	<div class="content">
		<div class="settingsWrap">
			<div class="displayUserProfile displayUserSettings">
				<figure>
					<?php if ($user["avatar"] !== NULL) {  ?>
						<img src="/assets/images/users/<?=$user["id"]?>/<?=$user["avatar"]?>" />
					<?php } else { ?>
						<img src="/assets/images/profileicon.png" />
					<?php } ?>
				</figure>
				<h4><?=$user["name"]?></h4>
				<h5>@<?=$user["username"]?></h5>
				<p><?=$user["about"]?></p>
			</div>
			<div class="settings">
				<h2 class="settingsHeading">Account settings</h2>

				<form action="app/settings.php" method="post" class="settingsForm" enctype="multipart/form-data">
					<?php if ($error) { ?>
						<div class="settingsError">
								<?= $error; ?>
						</div>
					<?php unset($_SESSION["error"]); } ?>
					<div class="change">
						<h3>Change username:</h3>
						<input type="text" name="editUsername" value="<?=$user['username']?>">
					</div>

					<div class="change">
						<h3>Change email:</h3>
						<input type="text" name="editEmail" value="<?=$user['email']?>">
					</div>

					<div class="change">
						<h3>Change name:</h3>
						<input type="text" name="editFullName" value="<?=$user['name']?>">
					</div>


					<div class="change">
						<h3>Change password:</h3>
						<input type="password" name="editPassword" placeholder="Write new password..."></br>
						<input type="password" name="repeatPassword" placeholder="Repeat new password...">
					</div>

					<div class="change">
						<h3>About me:</h3>
							<textarea name="about"><?= $user["about"]?></textarea>
					</div>

					<div class="change">
						<h3>Upload profile picture:</h3>
						<input type="file" name="avatar" accept="image/png, image/jpeg">
						<div class="placeholderAvatar">
							<?php if ($user["avatar"] !== NULL) {  ?>
								<img src="/assets/images/users/<?=$user["id"]?>/<?=$user["avatar"]?>" />
							<?php } else { ?>
								<img src="/assets/images/smiley.jpg" />
							<?php } ?>
						</div>
					</div>

					<div class="change saveChanges">
						<h3>Save changes:</h3>
						<input type="password" name="saveWithPassword" placeholder="Type in your password...">
						<input type="submit" name="saveChanges" value="Save">
					</div>

				</form>
			</div>
		</div>
	</div>

</div> <!-- end page -->
<?php
require __DIR__."/views/partials/navigation.php";
require __DIR__."/views/partials/footer.php";
?>
