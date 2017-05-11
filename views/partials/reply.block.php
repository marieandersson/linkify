<div class="commentReply comment<?=$reply["id"]?>">
	<div class="commentDiv">
		<p class="commentContent"><?=$reply["comment"]?></p>
		<div class="commentInfoAndReply">
			<p class="commentPublished">
				Posted by
				<span class="commentAuthor">
				<?php // name only link if user is logged in
                if (checkLogin($db)) {
                    ?>
					<a href="/profile/<?=$reply['username']?>">
					<?php 
                }
                    echo ucfirst($reply["username"]);
                    if (checkLogin($db)) {
                        ?>
					</a>
				<?php 
                    } ?>
				</span>
				on <?=date('jS \of M H:i', strtotime($reply["published"]));  if ($reply["edited"]) {
                        ?> (has been edited)<?php 
                    } ?>.
			</p>
		</div>
	</div>
	<div class="editCommentForm">
		<form action="app/posts/comments.php" method="post">
			<input type="hidden" name="commentIdForEdit" class="commentIdForEdit" value="<?=$reply["id"]?>">
			<input type="text" name="editComment" class="editComment" value="<?=$reply["comment"]?>">
			<input type="submit" name="saveEditComment" value="Save" class="saveEditComment">
		</form>
	</div>

	<?php if (checkLogin($db) && $reply["user_id"] == $_SESSION["login"]["id"]) {
                        ?>
	<form action="app/posts/comments.php" method="post" class="commentSettings">
		<button class="showPostSettings"><img src="/assets/images/settingswheel.png" alt="settings" /></button>
		<div class="postSettingsButtons commentSettingsButtons">
			<input type="hidden" name="commentId" class="commentId" value="<?=$reply["id"]?>">
			<button class="editCommentButton">Edit</button>
			<input type="submit" name="deleteComment" class="deleteComment" value="Delete">
		</div>
	</form>
	<?php 
                    } ?>
</div>
