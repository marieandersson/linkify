<!-- post content -->
<div class="editMessage"><?php if(isset($editMessage)) echo $editMessage; ?></div>
<div class="postContent">
	<h4><a href="<?=$post["url"]?>"><?=$post["subject"]?></a></h4>
	<p><?=$post["description"]?></p>
	<!-- user content -->
	<div class="postUser">
		<p>Posted by <a href="#"><?=$post["name"]?></a> on <?=date('jS \of M h:i', strtotime($post["published"]))?>.</p>
	</div>
</div>

<!-- edit form shown on button click -->
<?php if ($post["user_id"] == $_SESSION["login"]["id"]) { ?>
	<div class="editPostForm">
		<form action="index.php" method="post">
			<input type="hidden" name="postIdForEdit" value="<?=$post["id"]?>">
			<div class="editInputField">
				<label for="editSubject">Subject:</label>
				<input type="text" name="editSubject" value="<?=$post["subject"]?>">
			</div>
			<div class="editInputField">
				<label for="editUrl">Link url:</label>
				<input type="text" name="editUrl" value="<?=$post["url"]?>">
			</div>
			<div class="editInputField">
				<label for="editDescription">Description:</label>
				<input type="text" name="editDescription" value="<?=$post["description"]?>">
			</div>
			<input type="submit" name="saveEdit" value="Save" class="saveEdit">
		</form>
	</div>
<?php } ?>

<!-- edit, delete and comment -->
<div class="postButtons">
	<form action="index.php" method="post">
		<?php if ($post["user_id"] == $_SESSION["login"]["id"]) { ?>
			<button class="showPostSettings"><img src="/assets/images/settingswheel.png" /></button>
			<div class="postSettingsButtons">
				<button class="editButton">Edit post</button>
				<input type="submit" name="deletePost" value="Delete post" class="deleteButton">
			</div>
		<?php } ?>
		<div class="inputComment">
			<input type="hidden" name="postId" value="<?=$post["id"]?>">
			<input type="text" name="comment" placeholder="Say something about this...">
			<input type="submit" name="commentPost" value="Submit">
		</div>
		<!-- user only able to edit or delete own posts -->
	</form>
</div>
