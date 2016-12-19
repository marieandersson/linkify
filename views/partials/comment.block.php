<div class="comment">
	<p class="commentContent"><?=$comment["name"]?> said: <?=$comment["comment"]?></p>

	<!-- edit comment form shown on click -->
	<div class="editCommentForm">
		<form action="index.php" method="post">
			<input type="hidden" name="postIdForEditComment" value="<?=$comment["id"]?>">
			<input type="text" name="editComment" value="<?=$comment["comment"]?>">
			<input type="submit" name="saveEditComment" value="Save" class="saveEdit">
		</form>
	</div>

	<form action="index.php" method="post">
		<input type="hidden" name="commentId" value="<?=$comment["id"]?>">
		<input type="hidden" name="postId" value="<?=$post["id"]?>">
		<button class="replyButton">Reply</button>
		<div class="replyFields">
			<input type="text" name="comment" placeholder="Reply to this comment.">
			<input type="submit" name="replySubmit" value="Reply">
		</div>
		<?php if ($comment["user_id"] == $_SESSION["login"]["id"]) { ?>
		<button class="editCommentButton">Edit</button>
		<input type="submit" name="deleteComment" value="Delete">
		<?php } ?>
	</form>
</div>
