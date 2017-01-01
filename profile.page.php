<?php
require __DIR__."/autoload.php";
require __DIR__."/views/partials/header.php";
$user = getUserInfo($db);
$posts = getPosts($db);
$profile = getProfileInfo($db, $_GET["user"]);
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

	<div class="profileWrap">

		<div class="displayUserProfile">
			<figure>
				<?php if ($profile["avatar"] !== NULL) {  ?>
					<img src="/assets/images/users/<?=$profile["id"]?>/<?=$profile["avatar"]?>" />
				<?php } else { ?>
					<img src="/assets/images/placeholder/smiley.jpg" />
				<?php } ?>
			</figure>
			<h4><?=$profile["name"]?></h4>
			<h5>@<?=$profile["username"]?></h5>
			<p><?=$profile["about"]?></p>
		</div>

		<div class="postsOnProfile">
			<?php if ($profile["id"] == $_SESSION["login"]["id"]) {
				require __DIR__."/views/partials/newpost.block.php";
			}	?>

			<div class="displayPosts">
				<!-- check if any posts exists -->
				<?php if ($posts) {
					$userPosts = [];
					foreach ($posts as $post) {
						if ($post["user_id"] == $profile["id"]) {
							$userPosts[] = $post;
						}
					}
					usort($userPosts, "sortByDate");
					foreach ($userPosts as $post) { ?>
						<div class="post">
						<?php
							require __DIR__."/views/partials/post.block.php";
						?>
						</div>
				<?php }} ?>
			</div>
		</div>


	</div>

</div>
</div> <!-- end page -->
<script src="/assets/scripts/handleposts.js"></script>

<?php
require __DIR__."/views/partials/navigation.php";
require __DIR__."/views/partials/footer.php";
?>
