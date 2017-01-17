<?php
require __DIR__."/../app/posts/sortposts.php";
require __DIR__."/partials/header.php";
?>

	<div class="content">
		<h4 class="clickToShowNewPostForm">Share a link +</h4>
		<!-- client side validation error message -->
		<div class="jsMessage">
		</div>

		<?php // server side validation error message
		if ($message) { ?>
		<div class="message">
			<?= $message; ?>
		</div>
		<?php unset($_SESSION["message"]); } ?>

		<main class="homeMain">
			<!-- write new post -->
			<?php require __DIR__."/partials/newpost.block.php";	?>

			<!-- display existing posts -->
			<div class="posts">
				<div class="displayPosts postsOnHomePage">
				<!-- check if any posts exists -->
				<?php if ($posts) {
					foreach ($posts as $post) { ?>
					<div class="post">
					<?php require __DIR__."/partials/post.block.php";	?>
					</div>
					<?php }} else { ?>
					<div class="noPosts">
						<h2>Welcome to Linkify!</h2>
						<p>Linkify is brand new so there aren't any links to show quite yet. Share a link and be the first one out!</p>
					</div>
					<?php } ?>
				</div>
				<?php if (!$lastPost) { ?>
				<div class="showMoreDiv">
					<button class="showMore">Show more links...</button>
				</div>
				<?php } ?>
			</div> <!-- end posts -->

		</main>
	</div>

</div> <!-- end page -->

<?php require __DIR__."/partials/navigation.php"; ?>

<?php require __DIR__."/partials/footer.php"; ?>
