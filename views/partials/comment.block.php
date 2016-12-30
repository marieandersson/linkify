<p class="commentCount"><a href="#" class="commentLink">This post has <?=count($comments)?> <?=count($comments) == 1 ? "comment" : "comments"?>.
	Click here to <span class="readOrClose">read</span> <?=count($comments) == 1 ? "it" : "them"?>.</a></p>
<div class="comments">
	<?php foreach ($comments as $comment) {
		if ($comment["reply_to"] == NULL) { ?>
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

			<?php foreach ($comments as $reply) {
				if ($reply["reply_to"] == $comment["id"]) { ?>
					<div class="commentReply">
						<div class="commentDiv">
							<p class="commentContent"><?=$reply["name"]?>: <?=$reply["comment"]?></p>
							<p class="commentPublished">Posted on <?=date('jS \of M h:i', strtotime($reply["published"]))?></p>
						</div>
						<div class="editCommentForm">
							<form action="app/posts/comments.php" method="post">
								<input type="hidden" name="postIdForEditComment" value="<?=$reply["id"]?>">
								<input type="text" name="editComment" value="<?=$reply["comment"]?>">
								<input type="submit" name="saveEditComment" value="Save" class="saveEdit">
							</form>
						</div>

						<?php if (checkLogin($db) && $reply["user_id"] == $_SESSION["login"]["id"]) { ?>
						<form action="app/posts/comments.php" method="post">
							<div class="postSettingsButtons">
								<input type="hidden" name="commentId" value="<?=$reply["id"]?>">
								<button class="editCommentButton">Edit</button>
								<input type="submit" name="deleteComment" value="Delete">
							</div>
							<button class="showPostSettings"><img src="/assets/images/settingswheel.png" /></button>
						</form>
						<?php } ?>
					</div>
			<?php }}
			 if (checkLogin($db)) { ?>
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
			</div>
			<?php } ?>
	<?php }} ?>
</div>
