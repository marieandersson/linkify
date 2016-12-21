<?php
require __DIR__."/../app/posts/newpost.php";
require __DIR__."/../app/posts/editpost.php";
require __DIR__."/../app/posts/comments.php";
require __DIR__."/partials/header.php";
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
