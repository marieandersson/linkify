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

				<!-- user profile -->
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

					<!-- write new post -->
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

					<!-- display existing posts -->
					<div class="displayPosts">
						<!-- check if any posts exists -->
						<?php if ($posts) {
							foreach ($posts as $post) { ?>
								<div class="post">
									<?php require __DIR__."/partials/post.block.php";
										// check if post has comments
										$comments = getComments($db, $post["id"]);
										if ($comments) {
											require __DIR__."/partials/comment.block.php";
										}
									?>
								</div>
						<?php }} ?>
					</div>

				</div> <!-- end posts -->

		</main>
	</div>

</div> <!-- end page -->


<?php require __DIR__."/partials/navigation.php"; ?>

<?php require __DIR__."/partials/footer.php"; ?>
