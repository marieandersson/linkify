<!-- user content -->
<div class="postUser">
	<figure>
		<?php if ($post["avatar"] !== NULL) {  ?>
			<img src="/assets/images/users/<?=$post["user_id"]?>/<?=$post["avatar"]?>" />
		<?php } else { ?>
			<img src="/assets/images/placeholder/smiley.jpg" />
		<?php } ?>
	</figure>
	<p>@<?=$post["username"]?></p>
</div>
<!-- post content -->
<div class="editMessage"><?php if(isset($editMessage)) echo $editMessage; ?></div>
<div class="postContent">
	<a href="<?=$post["url"]?>"><?=$post["subject"]?></a>
	<p><?=$post["description"]?></p>
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
<!-- edit, delete and comment buttons-->
<div class="postButtons">
	<form action="index.php" method="post">
		<input type="hidden" name="postId" value="<?=$post["id"]?>">
		<input type="text" name="comment" placeholder="Say something about this">
		<input type="submit" name="commentPost" value="Comment">
		<!-- user only able to edit or delete own posts -->
		<?php if ($post["user_id"] == $_SESSION["login"]["id"]) { ?>
			<button class="editButton">Edit</button>
			<input type="submit" name="deletePost" value="Delete">
		<?php } ?>
	</form>
</div>
