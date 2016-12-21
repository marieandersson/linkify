<div class="newPost">
	<form action="<?=($_SERVER['PHP_SELF'])?>" method="post">
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
