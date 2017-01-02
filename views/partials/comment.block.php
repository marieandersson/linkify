<div class="comment">
	<div class="commentDiv">
		<p class="commentContent"><?=$comment["name"]?>: <?=$comment["comment"]?></p>
		<p class="commentPublished">Posted on <?=date('jS \of M h:i', strtotime($comment["published"]))?></p>
	</div>
	<!-- edit comment form shown on click -->
	<div class="editCommentForm">
		<form action="app/posts/comments.php" method="post">
			<input type="hidden" name="postIdForEditComment" value="<?=$comment["id"]?>">
			<input type="text" name="editComment" value="<?=$comment["comment"]?>">
			<input type="submit" name="saveEditComment" value="Save" class="saveEdit">
		</form>
	</div>

	<?php if (checkLogin($db) && $comment["user_id"] == $_SESSION["login"]["id"]) { ?>
	<form action="app/posts/comments.php" method="post">
		<div class="postSettingsButtons">
			<input type="hidden" name="commentId" value="<?=$comment["id"]?>">
			<button class="editCommentButton">Edit</button>
			<input type="submit" name="deleteComment" value="Delete">
		</div>
		<button class="showPostSettings"><img src="/assets/images/settingswheel.png" /></button>
		<?php } ?>
	</form>
</div>
