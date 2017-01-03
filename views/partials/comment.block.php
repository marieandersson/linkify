<div class="comment comment<?=$comment["id"]?>">
	<div class="commentDiv">
		<p class="commentContent"><?=$comment["name"]?>: <span class="commentText"><?=$comment["comment"]?></span></p>
		<p class="commentPublished">Posted on <?=date('jS \of M h:i', strtotime($comment["published"]))?></p>
	</div>
	<!-- edit comment form shown on click -->
	<div class="editCommentForm">
		<form action="app/posts/comments.php" method="post">
			<input type="hidden" name="commentIdForEdit" class="commentIdForEdit" value="<?=$comment["id"]?>">
			<input type="text" name="editComment" class="editComment" value="<?=$comment["comment"]?>">
			<input type="submit" name="saveEditComment" value="Save" class="saveEditComment">
		</form>
	</div>
	<?php if (checkLogin($db) && $comment["user_id"] == $_SESSION["login"]["id"]) { ?>
	<form action="app/posts/comments.php" method="post">
		<div class="postSettingsButtons">
			<input type="hidden" name="commentId" class="commentId" value="<?=$comment["id"]?>">
			<button class="editCommentButton">Edit</button>
			<input type="submit" name="deleteComment" class="deleteComment" value="Delete">
		</div>
		<button class="showPostSettings"><img src="/assets/images/settingswheel.png" /></button><?php } ?>
	</form>
</div>
<?php if (checkLogin($db)) { ?>
<div class="ReplyForm">
	<form action="app/posts/comments.php" method="post">
		<input type="hidden" name="commentId" value="<?=$comment["id"]?>">
		<input type="hidden" name="postId" value="<?=$post["id"]?>">
		<div class="replyFields">
			<input type="text" name="comment" placeholder="Reply to this...">
			<input type="submit" name="replySubmit" value="Submit">
		</div>
		<button class="replyButton">Reply to this</button>
	</form>
</div><?php } ?>
