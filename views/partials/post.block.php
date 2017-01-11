<!-- post content -->
<div class="postAndVoteWrap post<?=$post["id"]?>">

	<div class="voteWrap">
		<?php $votes = countVotes($db, $post["id"]) ?>
		<form action ="app/posts/votes.php" method="post">
			<input type="hidden" name="postIdForVote" class="postIdForVote" value="<?=$post["id"]?>">
			<input type="hidden" name="postUserIdForVote" class="postUserIdForVote" value="<?=$post["user_id"]?>">
			<input type="hidden" name="loggedInUser" class="loggedInUser" value="<?=$_SESSION["login"]["id"]?>">
			<input type="submit" class="up<?=(!checkLogin($db)) ? " notLoggedIn" : ""; ?>" name="up" value="">
			<span class="votes<?=(!checkLogin($db)) ? " notLoggedInVotes" : ""; ?>"><?= (!$votes["sum_votes"] == NULL) ? $votes["sum_votes"] : 0 ?></span>
			<input type="submit" class="down<?=(!checkLogin($db)) ? " notLoggedIn" : ""; ?>" name="down" value="">
		</form>
	</div>

	<div class="postWrap">
		<div class="editMessage"><?php if(isset($editMessage)) echo $editMessage; ?></div>
		<h4><a href="<?=$post["url"]?>"><?=$post["subject"]?></a></h4>
		<div class="postDiv">
			<div class="postContent">
				<p><?=$post["description"]?></p>
				<!-- user content -->
				<div class="postUser">
					<p>Posted by
					<?php // name only link if user is logged in
					if (checkLogin($db)) { ?>
						<a href="profile.page.php/?user=<?=$post["username"]?>">
					<?php }
					echo $post["name"];
					if (checkLogin($db)) { ?>
						</a>
						<?php } ?>
						on <?=date('jS \of M H:i', strtotime($post["published"]));
						if ($post["edited"]) { ?> (has been edited)<?php } ?>.
					</p>
				</div>
			</div>

			<!-- edit form shown on button click, only to logged in user on own posts -->
			<?php if (checkLogin($db) && $post["user_id"] == $_SESSION["login"]["id"]) { ?>
			<div class="editPostForm">
				<form action="app/posts/editpost.php" method="post">
					<input type="hidden" name="postIdForEdit" class="postIdForEdit" value="<?=$post["id"]?>">
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
				<form action="app/posts/editpost.php" method="post">
					<button class="showPostSettings"><img src="/assets/images/settingswheel.png" /></button>
					<div class="postSettingsButtons">
						<input type="hidden" name="postId" class="postButtonsId" value="<?=$post["id"]?>">
						<button class="editButton">Edit post</button>
						<input type="submit" name="deletePost" value="Delete post" class="deleteButton">
					</div>
				</form>
				<?php } ?>
			</div>
		</div>

		<?php if (checkLogin($db)) { ?>
		<form action="app/posts/comments.php" method="post" class="commentForm">
			<div class="inputComment">
				<input type="hidden" name="postId" value="<?=$post["id"]?>">
				<input type="text" name="comment" placeholder="Say something about this...">
				<input type="submit" name="commentPost" value="Submit" class="commentPost">
			</div>
			<!-- user only able to edit or delete own posts -->
		</form>
		<?php } else { ?>
			<div class="loginLink">
				<p>Wanna discuss this? Please log in first. (Link to login)</p>
			</div>
		<?php }
		// check if post has comments
		$comments = getComments($db, $post["id"]); ?>
		<p class="commentCount"><?php if ($comments) { ?>
			<a href='#' class='commentLink'>This post has comments. Click here to <span class='readOrClose'>read</span> them.</a>
		<?php } ?></p>
		<?php if ($comments) { ?>
		<div class="comments">
				<?php foreach ($comments as $comment) {
				if ($comment["reply_to"] == NULL) { ?>
			<div class="commentWrap">
				<?php require __DIR__."/../partials/comment.block.php"; ?>
				<div class="replies">
				<?php foreach ($comments as $reply) {
				if ($reply["reply_to"] == $comment["id"]) { ?>
					<div class="replyWrap">
						<?php require __DIR__."/../partials/reply.block.php"; ?>
					</div>
				<?php }} ?>
				</div>
			</div>
			<?php	}} ?>
		</div>
		<?php } ?>
	</div>
</div>
