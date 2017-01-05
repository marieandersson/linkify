<?php
// get posts and handle users sort requests
require __DIR__."/../app/posts/sortposts.php";
require __DIR__."/partials/header.php";
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

				<div class="posts">

					<!-- write new post -->
					<?php require __DIR__."/partials/newpost.block.php";	?>

					<!-- display existing posts -->
					<div class="displayPosts">
						<!-- check if any posts exists -->
						<?php if ($posts) {
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

<?php require __DIR__."/partials/navigation.php"; ?>

<?php require __DIR__."/partials/footer.php"; ?>
