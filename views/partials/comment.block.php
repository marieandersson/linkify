<div class="comment comment<?=$comment["id"]?>">
	<div class="commentDiv">
		<p class="commentContent"><?=$comment["comment"]?></p>
		<div class="commentInfoAndReply">
			<p class="commentPublished">
				Posted by
				<span class="commentAuthor">
				<?php // username only a link if user is logged in
				if (checkLogin($db)) { ?>
					<a href="/profile/<?=$comment['username']?>">
				<?php }
				echo ucfirst($comment["username"]);
				if (checkLogin($db)) { ?>
					</a>
					<?php } ?>
				</span>
				on <?=date('jS \of M H:i', strtotime($comment["published"])); if ($comment["edited"]) { ?> (has been edited)<?php } ?>.
			</p>
			<?php if (checkLogin($db)) { ?><p class="replyButton">Reply to this.</p><?php } ?>
		</div>
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
	<form action="app/posts/comments.php" method="post" class="commentSettings">
		<button class="showPostSettings"><img src="/assets/images/settingswheel.png" alt="settings"/></button><?php } ?>
		<div class="postSettingsButtons commentSettingsButtons">
			<input type="hidden" name="commentId" class="commentId" value="<?=$comment["id"]?>">
			<button class="editCommentButton">Edit</button>
			<input type="submit" name="deleteComment" class="deleteComment" value="Delete">
		</div>
	</form>
</div>
<?php if (checkLogin($db)) { ?>
<div class="replyForm">
	<form action="app/posts/comments.php" method="post">
		<input type="hidden" name="commentId" class="commentIdReply" value="<?=$comment["id"]?>">
		<input type="hidden" name="postId" class="postIdReply" value="<?=$post["id"]?>">
		<div class="replyFields">
			<input type="text" name="comment" placeholder="Reply to this...">
			<input type="submit" name="replySubmit" class="replySubmit" value="Submit">
		</div>
	</form>
</div><?php } ?>
