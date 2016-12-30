
<?php
// if error message
	if ($message) { ?>
	<div class="message">
		<?= $message; ?>
	</div>
<?php unset($_SESSION["message"]); } ?>

<div class="newPost">
	<form action="app/posts/newpost.php" method="post">
		<h4>Share a link</h4>
		<div class="postMessage"><?php if(isset($postMessage)) echo $postMessage; ?></div>
		<div class="newPostFields">
			<input type="text" name="subject" placeholder="Subject">
			<input type="text" name="url" placeholder="Link url">
			<input type="text" name="description" placeholder="Short description" maxlength="255">
			<input type="submit" name="postLink" value="Share">
		</div>
	</form>
</div>
