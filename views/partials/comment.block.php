<div class="comments">
	<p>This post has <?=count($comments)?> <?=count($comments) == 1 ? "comment" : "comments"?>.</p>
	<?php foreach ($comments as $comment) {
		if ($comment["reply_to"] == NULL) { ?>
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

				<?php if ($comment["user_id"] == $_SESSION["login"]["id"]) { ?>
				<form action="index.php" method="post">
					<input type="hidden" name="commentId" value="<?=$comment["id"]?>">
					<button class="editCommentButton">Edit</button>
					<input type="submit" name="deleteComment" value="Delete">
					<?php } ?>
				</form>
			</div>

			<?php foreach ($comments as $reply) {
				if ($reply["reply_to"] == $comment["id"]) { ?>
					<div class="commentReply">
						<p class="commentContent"><?=$reply["name"]?> answered: <?=$reply["comment"]?></p>

						<div class="editCommentForm">
							<form action="index.php" method="post">
								<input type="hidden" name="postIdForEditComment" value="<?=$reply["id"]?>">
								<input type="text" name="editComment" value="<?=$reply["comment"]?>">
								<input type="submit" name="saveEditComment" value="Save" class="saveEdit">
							</form>
						</div>

						<?php if ($reply["user_id"] == $_SESSION["login"]["id"]) { ?>
						<form action="index.php" method="post">
							<input type="hidden" name="commentId" value="<?=$reply["id"]?>">
							<button class="editCommentButton">Edit</button>
							<input type="submit" name="deleteComment" value="Delete">
						</form>
						<?php } ?>
					</div>
			<?php }} ?>

			<div class="ReplyForm">
				<form action="index.php" method="post">
					<input type="hidden" name="commentId" value="<?=$comment["id"]?>">
					<input type="hidden" name="postId" value="<?=$post["id"]?>">
					<button class="replyButton">Reply</button>
					<div class="replyFields">
						<input type="text" name="comment" placeholder="Reply to this comment.">
						<input type="submit" name="replySubmit" value="Reply">
					</div>
				</form>
			</div>
	<?php }} ?>
</div>
