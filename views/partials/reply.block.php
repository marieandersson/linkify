<div class="commentReply comment<?=$reply["id"]?>">
	<div class="commentDiv">
		<p class="commentContent"><?=$reply["name"]?>: <span class="commentText"><?=$reply["comment"]?></span></p>
		<p class="commentPublished">Posted on <?=date('jS \of M h:i', strtotime($reply["published"]))?></p>
	</div>
	<div class="editCommentForm">
		<form action="app/posts/comments.php" method="post">
			<input type="hidden" name="commentIdForEdit" class="commentIdForEdit" value="<?=$reply["id"]?>">
			<input type="text" name="editComment" class="editComment" value="<?=$reply["comment"]?>">
			<input type="submit" name="saveEditComment" value="Save" class="saveEditComment">
		</form>
	</div>

	<?php if (checkLogin($db) && $reply["user_id"] == $_SESSION["login"]["id"]) { ?>
	<form action="app/posts/comments.php" method="post">
		<div class="postSettingsButtons">
			<input type="hidden" name="commentId" class="commentId" value="<?=$reply["id"]?>">
			<button class="editCommentButton">Edit</button>
			<input type="submit" name="deleteComment" class="deleteComment" value="Delete">
		</div>
		<button class="showPostSettings"><img src="/assets/images/settingswheel.png" /></button>
	</form>
	<?php } ?>
</div>
