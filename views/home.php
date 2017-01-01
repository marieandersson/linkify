<?php
require __DIR__."/partials/header.php";
$user = getUserInfo($db);
$posts = getPosts($db);
?>

	<div class="content">
		<!-- client side validation error message -->
		<div class="jsMessage">
		</div>
		<?php
		// server side validation error message
			if ($message) { ?>
			<div class="message">
				<?= $message; ?>
			</div>
		<?php unset($_SESSION["message"]); } ?>

		<main class="homeMain">

				<!-- user profile -->
				<div class="displayUser">
					<a href="/profile.page.php/?user=<?=$_SESSION["login"]["username"]?>">
						<figure>
							<?php if ($user["avatar"] !== NULL) {  ?>
								<img src="/assets/images/users/<?=$user["id"]?>/<?=$user["avatar"]?>" />
							<?php } else { ?>
								<img src="/assets/images/placeholder/smiley.jpg" />
							<?php } ?>
						</figure>
						<h4><?=$user["name"]?></h4>
						<h5>@<?=$user["username"]?></h5>
					</a>
				</div>

				<div class="posts">

					<!-- write new post -->
					<?php require __DIR__."/partials/newpost.block.php";	?>

					<!-- display existing posts -->
					<div class="displayPosts">
						<!-- check if any posts exists -->
						<?php if ($posts) {
							usort($posts, "sortByDate");
							foreach ($posts as $post) { ?>
								<div class="post">
									<?php require __DIR__."/partials/post.block.php";	?>
								</div>
						<?php }} ?>
					</div>

				</div> <!-- end posts -->

		</main>
	</div>

</div> <!-- end page -->
<script src="/assets/scripts/handleposts.js"></script>

<?php require __DIR__."/partials/navigation.php"; ?>

<?php require __DIR__."/partials/footer.php"; ?>
