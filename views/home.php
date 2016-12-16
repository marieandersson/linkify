<?php
require __DIR__."/partials/header.php";
require __DIR__."/../app/posts/newpost.php";
require __DIR__."/../app/posts/editpost.php";
require __DIR__."/../app/posts/comments.php";
$user = getUserInfo($db);
$posts = getPosts($db);
?>

	<div class="content">

		<main class="homeMain">

			<div class="homeTopWrap">
				<div class="displayUser">
					<figure>
						<?php if ($user["avatar"] !== NULL) {  ?>
							<img src="/assets/images/users/<?=$user["id"]?>/<?=$user["avatar"]?>" />
						<?php } else { ?>
							<img src="/assets/images/placeholder/smiley.jpg" />
						<?php } ?>
					</figure>
					<h4><?=$user["name"]?></h4>
					<h5>@<?=$user["username"]?></h5>
				</div>

				<div class="posts">

					<div class="newPost">
						<form action="index.php" method="post">
							<h4>Share a link</h4>
							<div class="postMessage"><?php if(isset($postMessage)) echo $postMessage; ?></div>
							<div class="newPostFields">
								<input type="text" name="subject" placeholder="Subject">
								<input type="text" name="url" placeholder="Link url">
								<input type="text" name="description" placeholder="Short description">
								<input type="submit" name="postLink" value="Share">
							</div>
						</form>
					</div>

					<div class="displayPosts">
						<?php if ($posts) {
							foreach ($posts as $post) { ?>
								<div class="post">
									<!-- user content -->
									<div class="postUser">
										<figure>
											<?php if ($post["avatar"] !== NULL) {  ?>
												<img src="/assets/images/users/<?=$post["user_id"]?>/<?=$post["avatar"]?>" />
											<?php } else { ?>
												<img src="/assets/images/placeholder/smiley.jpg" />
											<?php } ?>
										</figure>
										<p>@<?=$post["username"]?></p>
									</div>
									<!-- post content -->
									<div class="editMessage"><?php if(isset($editMessage)) echo $editMessage; ?></div>
									<div class="postContent">
										<a href="<?=$post["url"]?>"><?=$post["subject"]?></a>
										<p><?=$post["description"]?></p>
									</div>
									<!-- edit form shown on button click -->
									<?php if ($post["user_id"] == $_SESSION["login"]["id"]) { ?>
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
									<!-- edit, delete or comment -->
									<div class="postButtons">
										<form action="index.php" method="post">
											<input type="hidden" name="postId" value="<?=$post["id"]?>">
											<input type="text" name="comment" placeholder="Say something about this">
											<input type="submit" name="commentPost" value="Comment">
											<!-- user only able to edit or delete own posts -->
											<?php if ($post["user_id"] == $_SESSION["login"]["id"]) { ?>
												<button class="editButton">Edit</button>
												<input type="submit" name="deletePost" value="Delete">
											<?php } ?>
										</form>
									</div>
								</div>
						<?php }} ?>
					</div>

				</div> <!-- end posts -->
			</div> <!-- end homeTopWrap -->


		</main>
	</div>

	<p>Start page, small profile, share links, news feed. edit links, delete links, comment on links. up and down vote links.</p>
</div> <!-- end page -->


<?php require __DIR__."/partials/navigation.php"; ?>

<?php require __DIR__."/partials/footer.php"; ?>
