<!-- post content -->
<div class="postAndVoteWrap">

	<div class="voteWrap">
		<span class="up"></span>
		<span class="votes">0</span>
		<span class="down"></span>
	</div>

	<div class="postWrap">
		<div class="editMessage"><?php if(isset($editMessage)) echo $editMessage; ?></div>
		<h4><a href="<?=$post["url"]?>"><?=$post["subject"]?></a></h4>
		<div class="postDiv">
			<div class="postContent">
				<p><?=$post["description"]?></p>
				<!-- user content -->
				<div class="postUser">
					<p>Posted by <a href="#"><?=$post["name"]?></a> on <?=date('jS \of M h:i', strtotime($post["published"]))?>.</p>
				</div>
			</div>

			<!-- edit form shown on button click -->
			<?php if (checkLogin($db) && $post["user_id"] == $_SESSION["login"]["id"]) { ?>
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
				<?php if (checkLogin($db) && $post["user_id"] == $_SESSION["login"]["id"]) { ?>
				<form action="index.php" method="post">
					<div class="postSettingsButtons">
						<input type="hidden" name="postId" value="<?=$post["id"]?>">
						<button class="editButton">Edit post</button>
						<input type="submit" name="deletePost" value="Delete post" class="deleteButton">
					</div>
					<button class="showPostSettings"><img src="/assets/images/settingswheel.png" /></button>
				</form>
				<?php } ?>
			</div>
		</div>

		<?php if (checkLogin($db)) { ?>
		<form action="index.php" method="post">
			<div class="inputComment">
				<input type="hidden" name="postId" value="<?=$post["id"]?>">
				<input type="text" name="comment" placeholder="Say something about this...">
				<input type="submit" name="commentPost" value="Submit">
			</div>
			<!-- user only able to edit or delete own posts -->
		</form>
		<?php } else { ?>
			<p class="loginLink">Wanna discuss this? Please log in first. (Link to login)</p>
		<?php }
		// check if post has comments
		$comments = getComments($db, $post["id"]);
		if ($comments) {
			require __DIR__."/../partials/comment.block.php";
		} ?>
	</div>
</div>
